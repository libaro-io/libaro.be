import { ref, nextTick, type Ref } from 'vue';
import type { ChatMessage, ChatApiResponse, ChatReference } from '@interfaces/ExperienceChatInterface';
import { ChatRoleEnum } from '@enums/ChatRoleEnum';
import { getTrans } from '@composables/UseTranslationHelper';
import axios from 'axios';

interface DemoStep {
    role: ChatRoleEnum;
    content: string;
    references?: ChatReference[];
}

interface UseExperienceChatReturn {
    messages: Ref<ChatMessage[]>;
    userInput: Ref<string>;
    isLoading: Ref<boolean>;
    demoPlayed: Ref<boolean>;
    demoPlaying: Ref<boolean>;
    errorMessage: Ref<string | null>;
    playDemo: () => Promise<void>;
    sendMessage: () => Promise<void>;
    reset: () => void;
    getFormattedMessageForContact: () => Promise<string>;
}

function getDemoConversation(locale: string): DemoStep[] {
    const localePrefix = locale ? `/${locale}` : "";
    return [
        {
            role: ChatRoleEnum.USER,
            content: getTrans("sections.experience-chat.demo.user_1"),
        },
        {
            role: ChatRoleEnum.ASSISTANT,
            content: getTrans("sections.experience-chat.demo.assistant_1"),
            references: [
                { project_name: getTrans("sections.experience-chat.demo.assistant_1_ref_1_name"), why_relevant: getTrans("sections.experience-chat.demo.assistant_1_ref_1_why"), link: `${localePrefix}/realisaties/deca-time-digitaal-slim-werfbeheer-robaws`, image: "projects/Libaro-Decatime.webp" },
                { project_name: getTrans("sections.experience-chat.demo.assistant_1_ref_2_name"), why_relevant: getTrans("sections.experience-chat.demo.assistant_1_ref_2_why"), link: `${localePrefix}/realisaties/royal_antwerp_ticketing`, image: "projects/rafc-ticketing-platform.webp" },
            ],
        },
    ];
}

const TYPING_DELAY_MS = 800;
const WORD_INTERVAL_MS = 40;
const MAX_HISTORY_MESSAGES = 4;

/**
 * Composable for managing experience chat functionality.
 * @param scrollToBottom - Function to scroll to the bottom of the chat container.
 * @param localeRef - Locale reference for translations, defaults to 'en'.
 * @returns Chat-related reactive properties and functions.
 */
export function useExperienceChat(
    scrollToBottom: () => void,
    localeRef: Ref<string> | string = "en"
): UseExperienceChatReturn {
    const messages = ref<ChatMessage[]>([]);
    const userInput = ref('');
    const isLoading = ref(false);
    const demoPlayed = ref(false);
    const demoPlaying = ref(false);
    const errorMessage = ref<string | null>(null);

    const sleep = (ms: number): Promise<void> => new Promise((resolve) => setTimeout(resolve, ms));

    const typeMessageWordByWord = async (index: number, fullContent: string): Promise<void> => {
        const words = fullContent.split(' ');

        for (let i = 0; i < words.length; i++) {
            if (messages.value[index]) {
                messages.value[index].displayedContent = words.slice(0, i + 1).join(' ');
                await nextTick();
                scrollToBottom();
                await sleep(WORD_INTERVAL_MS);
            }
        }

        if (messages.value[index]) {
            messages.value[index].displayedContent = fullContent;
            messages.value[index].isTyping = false;
        }
        await nextTick();
        scrollToBottom();
        // References/contact CTA render after isTyping becomes false; scroll again after layout
        await sleep(80);
        scrollToBottom();
    };

    const addAssistantMessage = async (content: string, references?: ChatReference[]): Promise<void> => {
        messages.value.push({
            role: ChatRoleEnum.ASSISTANT,
            content: '',
            displayedContent: '',
            isTyping: true,
        });
        await nextTick();
        scrollToBottom();

        await sleep(TYPING_DELAY_MS);

        const idx = messages.value.length - 1;
        messages.value[idx].content = content;
        messages.value[idx].references = references;

        await typeMessageWordByWord(idx, content);
    };

    const addUserMessage = (content: string): void => {
        messages.value.push({
            role: ChatRoleEnum.USER,
            content,
            displayedContent: content,
            isTyping: false,
        });
    };

    const playDemo = async (): Promise<void> => {
        if (demoPlayed.value || demoPlaying.value) return;

        demoPlaying.value = true;

        const loc = typeof localeRef === "string" ? localeRef : localeRef.value;
        const demoConversation = getDemoConversation(loc);
        for (const step of demoConversation) {
            if (step.role === ChatRoleEnum.USER) {
                await sleep(400);
                addUserMessage(step.content);
                await nextTick();
                scrollToBottom();
            } else {
                await addAssistantMessage(step.content, step.references);
            }
        }

        demoPlaying.value = false;
        demoPlayed.value = true;
    };

    const MAX_MESSAGE_LENGTH = 2000;

    const sendMessage = async (): Promise<void> => {
        const text = userInput.value.trim();
        if (!text || isLoading.value || demoPlaying.value) return;

        if (text.length > MAX_MESSAGE_LENGTH) {
            errorMessage.value = 'sections.experience-chat.error_message_too_long';
            return;
        }

        errorMessage.value = null;
        userInput.value = '';

        addUserMessage(text);
        await nextTick();
        scrollToBottom();

        isLoading.value = true;
        messages.value.push({
            role: ChatRoleEnum.ASSISTANT,
            content: '',
            displayedContent: '',
            isTyping: true,
        });
        await nextTick();
        scrollToBottom();

        try {
            const loc = typeof localeRef === "string" ? localeRef : localeRef.value;
            const withContent = messages.value.filter(
                (m) => (m.role === ChatRoleEnum.USER || m.role === ChatRoleEnum.ASSISTANT) && (m.content ?? '').trim().length > 0
            );
            const previousTurns = withContent.slice(0, -1);
            const history = previousTurns.slice(-MAX_HISTORY_MESSAGES).map((m) => ({
                role: m.role === ChatRoleEnum.ASSISTANT ? 'assistant' : 'user',
                content: m.content,
            }));
            const { data } = await axios.post<ChatApiResponse>('/api/experience-chat', {
                message: text,
                locale: loc,
                history,
            });

            const idx = messages.value.length - 1;
            messages.value[idx].content = data.answer;
            messages.value[idx].references = data.references;
            messages.value[idx].contactLink = data.contact_link ?? null;

            await typeMessageWordByWord(idx, data.answer);
            await nextTick();
            scrollToBottom();
        } catch (err: unknown) {
            const idx = messages.value.length - 1;
            messages.value[idx].isTyping = false;
            messages.value[idx].content = '';
            messages.value[idx].displayedContent = '';
            const status = axios.isAxiosError(err) && err.response?.status;
            const hasMessageError = axios.isAxiosError(err) && err.response?.data?.errors?.message;
            errorMessage.value =
                status === 422 && hasMessageError
                    ? 'sections.experience-chat.error_message_too_long'
                    : 'sections.experience-chat.error';
        } finally {
            isLoading.value = false;
        }
    };

    const reset = (): void => {
        messages.value = [];
        demoPlayed.value = false;
        demoPlaying.value = false;
        errorMessage.value = null;
    };

    /** Full chat history formatted for the contact form message (used when user clicks Contact CTA). */
    const getFormattedMessageForContact = async (): Promise<string> => {
        const withContent = messages.value.filter(
            (m) => (m.role === ChatRoleEnum.USER || m.role === ChatRoleEnum.ASSISTANT) && (m.content ?? '').trim().length > 0
        );
        if (withContent.length === 0) return '';
        const history = withContent.map((m) => ({
            role: m.role === ChatRoleEnum.ASSISTANT ? 'assistant' : 'user',
            content: m.content ?? '',
        }));
        const loc = typeof localeRef === 'string' ? localeRef : localeRef.value;
        try {
            const { data } = await axios.post<{ message: string }>('/api/experience-chat/format-for-contact', {
                locale: loc,
                history,
            });
            return (data.message ?? '').trim();
        } catch {
            return '';
        }
    };

    return {
        messages,
        userInput,
        isLoading,
        demoPlayed,
        demoPlaying,
        errorMessage,
        playDemo,
        sendMessage,
        reset,
        getFormattedMessageForContact,
    };
}
