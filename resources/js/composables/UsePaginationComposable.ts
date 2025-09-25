import {router} from "@inertiajs/vue3";
import {computed, ComputedRef} from "vue";
import {PaginationInterface} from "@interfaces/PaginationInterface";

interface UsePaginationReturn<T> {
    goToNextPage: () => void;
    goToPreviousPage: () => void;
    canGoToNextPage: ComputedRef<boolean>;
    canGoToPreviousPage: ComputedRef<boolean>;
}

// Accept a getter so we always read the latest reactive pagination value
export function usePagination<T = unknown>(
    getPagination: () => PaginationInterface<T[]> | null | undefined,
    only: string[] = []
): UsePaginationReturn<T> {
    const canGoToNextPage = computed<boolean>(() => {
        const pagination = getPagination();
        return !!pagination?.next_page_url;
    });

    const canGoToPreviousPage = computed<boolean>(() => {
        const pagination = getPagination();
        return !!pagination?.prev_page_url;
    });

    const goToUrl = (url: string | null) => {
        if (!url) return;

        router.visit(url, {
            preserveState: true,
            preserveScroll: true,
            preserveUrl: true,
            only: only.length ? only : undefined,
        });
    };

    const goToNextPage = () => {
        const pagination = getPagination();
        goToUrl(pagination?.next_page_url || null);
    };

    const goToPreviousPage = () => {
        const pagination = getPagination();
        goToUrl(pagination?.prev_page_url || null);
    };

    return {
        goToNextPage,
        goToPreviousPage,
        canGoToNextPage,
        canGoToPreviousPage,
    };
}
