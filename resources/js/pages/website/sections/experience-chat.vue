<script setup lang="ts">
import { ref, onMounted, onUnmounted, nextTick, computed, watch } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { getTrans } from '@composables/UseTranslationHelper';
import { useS3Image } from '@composables/useS3Image';
import { useExperienceChat } from '@composables/UseExperienceChat';
import type { ChatReference } from '@interfaces/ExperienceChatInterface';
import type PageInterface from '@interfaces/PageInterface';
import type { TranslationKey } from '../../../translations/lang-keys';

const page = usePage<PageInterface>();
const locale = computed(() => page.props.pageProps?.locale ?? 'en');

const sectionRef = ref<HTMLElement | null>(null);
const chatBodyRef = ref<HTMLElement | null>(null);
const inputRef = ref<HTMLInputElement | null>(null);
const isSectionInView = ref(false);
let observer: IntersectionObserver | null = null;

const scrollToBottom = (): void => {
    if (chatBodyRef.value) {
        chatBodyRef.value.scrollTop = chatBodyRef.value.scrollHeight;
    }
};

const {
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
} = useExperienceChat(scrollToBottom, locale);

const goToContactWithContext = async (): Promise<void> => {
    const message = await getFormattedMessageForContact();
    const url = `/${locale.value}/contact` + (message ? `?message=${encodeURIComponent(message)}` : '');
    router.visit(url);
};

const inputDisabled = computed(() => isLoading.value || demoPlaying.value);

const handleSend = async (): Promise<void> => {
    await sendMessage();
    await nextTick();
    inputRef.value?.focus();
};

const handleKeydown = (e: KeyboardEvent): void => {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        handleSend();
    }
};

const dismissError = (): void => {
    errorMessage.value = null;
};

const refImageUrl = (refItem: ChatReference): string | undefined => {
    const url = refItem?.image ? useS3Image(refItem.image) : null;
    return url ?? undefined;
};

watch(locale, () => {
    reset();
    nextTick(() => {
        if (isSectionInView.value && !demoPlaying.value) {
            playDemo();
        }
    });
});

onMounted(() => {
    if (!sectionRef.value) return;

    observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                isSectionInView.value = entry.isIntersecting;
                if (entry.isIntersecting && !demoPlayed.value && !demoPlaying.value) {
                    playDemo();
                }
            });
        },
        { threshold: 0.3 },
    );

    observer.observe(sectionRef.value);
});

onUnmounted(() => {
    observer?.disconnect();
});
</script>
<template>
    <section
        ref="sectionRef"
        class="section-website-experience-chat"
    >
        <img
            src="/images/header_striped.webp"
            class="bg-image"
            alt="header"
        >
        <div class="container">
            <div class="grid">
                <div class="content">
                    <h2>{{ getTrans('sections.experience-chat.title') }}</h2>
                    <p>{{ getTrans('sections.experience-chat.subtitle') }}</p>
                    <a
                        :href="`/${locale}/contact`"
                        class="banner-cta"
                        @click.prevent="goToContactWithContext"
                    >
                        {{ getTrans('sections.experience-chat.banner_cta') }}
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div
                    class="chatbox"
                    role="region"
                    aria-label="Chat"
                >
                    <div
                        ref="chatBodyRef"
                        class="chatbox-body"
                        aria-live="polite"
                    >
                        <div
                            v-for="(msg, index) in messages"
                            :key="index"
                            :class="['chat-message', `chat-message--${msg.role}`]"
                            :style="{ animationDelay: `${index * 0.06}s` }"
                        >
                            <div class="chat-bubble">
                                <template v-if="msg.isTyping && !msg.displayedContent">
                                    <span
                                        class="typing-indicator"
                                        :aria-label="getTrans('sections.experience-chat.aria_typing')"
                                    >
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </span>
                                </template>
                                <template v-else>
                                    <span class="chat-text">{{ msg.displayedContent || msg.content }}</span>
                                </template>
                            </div>

                            <div
                                v-if="msg.references?.length && !msg.isTyping"
                                class="chat-references"
                            >
                                <a
                                    v-for="(refItem, refIdx) in msg.references"
                                    :key="refIdx"
                                    :href="refItem.link"
                                    class="chat-reference"
                                    :style="{ animationDelay: `${refIdx * 0.07}s` }"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <span class="chat-reference-image">
                                        <img
                                            v-if="refImageUrl(refItem)"
                                            :src="refImageUrl(refItem)"
                                            :alt="refItem.project_name"
                                            class="chat-reference-img"
                                        >
                                        <span
                                            v-else
                                            class="chat-reference-image-placeholder"
                                            aria-hidden="true"
                                        >
                                            <i class="fa-solid fa-folder"></i>
                                        </span>
                                    </span>
                                    <span class="chat-reference-text">
                                        <span class="chat-reference-name">{{ refItem.project_name }}</span>
                                        <span class="chat-reference-why">{{ refItem.why_relevant }}</span>
                                    </span>
                                </a>
                            </div>

                            <a
                                v-if="msg.contactLink && !msg.isTyping"
                                :href="msg.contactLink"
                                class="chat-contact-cta"
                                @click.prevent="goToContactWithContext"
                            >
                                <span class="chat-contact-cta-icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <span class="chat-contact-cta-text">
                                    <span class="chat-contact-cta-title">{{ getTrans('sections.experience-chat.contact_cta_title') }}</span>
                                    <span class="chat-contact-cta-subtitle">{{ getTrans('sections.experience-chat.contact_cta_subtitle') }}</span>
                                </span>
                            </a>
                        </div>

                        <div v-if="errorMessage" class="chat-error">
                            <span>{{ getTrans(errorMessage as TranslationKey) }}</span>
                            <button
                                class="chat-error-dismiss"
                                :aria-label="getTrans('sections.experience-chat.aria_dismiss_error')"
                                @click="dismissError"
                            >
                                &times;
                            </button>
                        </div>
                    </div>

                    <div class="chatbox-footer">
                        <input
                            ref="inputRef"
                            v-model="userInput"
                            type="text"
                            :disabled="inputDisabled"
                            :placeholder="getTrans('sections.experience-chat.placeholder')"
                            :aria-label="getTrans('sections.experience-chat.aria_type_question')"
                            @keydown="handleKeydown"
                        >
                        <button
                            :disabled="inputDisabled || !userInput.trim()"
                            :aria-label="getTrans('sections.experience-chat.aria_send')"
                            @click="handleSend"
                        >
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/experience-chat.css";
</style>
