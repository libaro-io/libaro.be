import { ref, type Ref } from 'vue';
import axios from 'axios';

export interface SmartFilterResponse {
    slugs: string[];
    summary: string;
}

interface UseSmartFilterReturn {
    isOpen: Ref<boolean>;
    isLoading: Ref<boolean>;
    userInput: Ref<string>;
    filterSummary: Ref<string>;
    filteredSlugs: Ref<string[] | null>;
    errorMessage: Ref<string | null>;
    applyFilter: (locale: string) => Promise<void>;
    clearFilter: () => void;
    open: () => void;
    close: () => void;
}

export function useSmartFilter(): UseSmartFilterReturn {
    const isOpen = ref(false);
    const isLoading = ref(false);
    const userInput = ref('');
    const filterSummary = ref('');
    const filteredSlugs = ref<string[] | null>(null);
    const errorMessage = ref<string | null>(null);

    const applyFilter = async (locale: string): Promise<void> => {
        const text = userInput.value.trim();
        if (!text || isLoading.value) return;

        errorMessage.value = null;
        isLoading.value = true;

        try {
            const { data } = await axios.post<SmartFilterResponse>('/api/smart-filter', {
                message: text,
                locale: locale || 'en',
            });
            filteredSlugs.value = data.slugs ?? [];
            filterSummary.value = data.summary ?? '';
            isOpen.value = false;
            userInput.value = '';
        } catch {
            errorMessage.value = 'projects.smart_filter.error';
        } finally {
            isLoading.value = false;
        }
    };

    const clearFilter = (): void => {
        filteredSlugs.value = null;
        filterSummary.value = '';
        errorMessage.value = null;
    };

    const open = (): void => {
        isOpen.value = true;
        errorMessage.value = null;
    };

    const close = (): void => {
        isOpen.value = false;
        errorMessage.value = null;
    };

    return {
        isOpen,
        isLoading,
        userInput,
        filterSummary,
        filteredSlugs,
        errorMessage,
        applyFilter,
        clearFilter,
        open,
        close,
    };
}
