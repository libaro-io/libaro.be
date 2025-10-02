import {router} from "@inertiajs/vue3";
import {computed, ComputedRef} from "vue";
import {PaginationInterface} from "@interfaces/PaginationInterface";

interface UsePaginationReturn {
    goToNextPage: () => void;
    goToPreviousPage: () => void;
    canGoToNextPage: ComputedRef<boolean>;
    canGoToPreviousPage: ComputedRef<boolean>;
}

// Accept a getter so we always read the latest reactive pagination value
export function usePagination<T = unknown>(
    getPagination: () => PaginationInterface<T[]> | null | undefined,
    only: string[] = []
): UsePaginationReturn {
    const canGoToNextPage = computed<boolean>(() => {
        const pagination = getPagination();
        return !!pagination?.next_page_url;
    });

    const canGoToPreviousPage = computed<boolean>(() => {
        const pagination = getPagination();
        return !!pagination?.prev_page_url;
    });

    const goToUrl = (url: string | null):void => {
        if (!url) return;

        router.visit(url, {
            preserveState: true,
            preserveScroll: true,
            preserveUrl: true,
            only: only.length ? only : undefined,
        });
    };

    const goToNextPage = ():void => {
        const pagination = getPagination();
        goToUrl(pagination?.next_page_url || null);
    };

    const goToPreviousPage = ():void => {
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
