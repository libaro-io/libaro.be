<script setup lang="ts">
import Website from "@layouts/website.vue";
import { getTrans } from "@composables/UseTranslationHelper";
import { ProjectInterface } from "@interfaces/ProjectInterface";
import CardComponent from "@components/card-component.vue";
import CardListComponent from "@components/card-list-component.vue";
import DetailProjectController from "@actions/App/Http/Controllers/DetailProjectController";
import { useS3Image } from "@composables/useS3Image";
import { useSmartFilter } from "@composables/UseSmartFilter";
import { usePage } from "@inertiajs/vue3";
import { computed, ref, watch, nextTick, onBeforeUnmount } from "vue";
import PageInterface from "@interfaces/PageInterface";
import type { TranslationKey } from "../../translations/lang-keys";

const props = defineProps<{
    projects: ProjectInterface[];
}>();

const page = usePage<PageInterface>();
const locale = computed(() => page.props.pageProps?.locale ?? "en");

const {
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
} = useSmartFilter();

const displayedProjects = computed(() => {
    if (filteredSlugs.value === null) return props.projects;
    const set = new Set(filteredSlugs.value.map((s) => s.toLowerCase()));
    return props.projects.filter((p) => set.has(p.slug.toLowerCase()));
});

const hasActiveFilter = computed(() => filteredSlugs.value !== null);

const hasFilteredResults = computed(
    () => (filteredSlugs.value?.length ?? 0) > 0
);

const fabWrapperRef = ref<HTMLElement | null>(null);

function handleClickOutside(event: MouseEvent): void {
    if (fabWrapperRef.value && !fabWrapperRef.value.contains(event.target as Node)) {
        close();
    }
}

watch(isOpen, (open) => {
    if (open) {
        nextTick(() => {
            document.addEventListener("click", handleClickOutside);
        });
    } else {
        document.removeEventListener("click", handleClickOutside);
    }
});

onBeforeUnmount(() => {
    document.removeEventListener("click", handleClickOutside);
});

function handleSubmit(): void {
    applyFilter(locale.value);
}
</script>
<template>
    <website
        :page-title="getTrans('projects.page_title')"
        :page-sub-title="getTrans('projects.page_sub_title')"
        :page-description="getTrans('projects.page_description')"
        :marginBottom="false"
        meta-key="projects"
        :header-options="{ whiteVariant: true }"
    >
        <div id="page-website-projects">
            <card-list-component>
                <card-component
                    v-for="project in displayedProjects"
                    :key="project.slug"
                    :link="DetailProjectController({ project: project.slug }).url"
                    :image="useS3Image(project.image)"
                    :title="project.name"
                    :sub-title="project.client.name"
                    :category="project.type"
                    :tags="project.tags"
                />
            </card-list-component>

            <div v-if="hasActiveFilter && displayedProjects.length === 0" class="smart-filter-no-results">
                <h2 class="smart-filter-no-results-title">{{ getTrans("projects.smart_filter.no_results") }}</h2>
                <button type="button" class="smart-filter-no-results-clear" @click="clearFilter">
                    {{ getTrans("projects.smart_filter.clear") }}
                </button>
            </div>

            <div ref="fabWrapperRef" class="smart-filter-fab-wrapper">
                <div v-if="hasActiveFilter" class="smart-filter-bar-above">
                    <p class="smart-filter-summary">{{ filterSummary }}</p>
                    <button
                        v-if="hasFilteredResults"
                        type="button"
                        class="smart-filter-clear"
                        @click="clearFilter"
                    >
                        {{ getTrans("projects.smart_filter.clear") }}
                    </button>
                </div>
                <button
                    type="button"
                    class="smart-filter-fab"
                    :class="{ 'is-active': hasActiveFilter }"
                    :aria-label="getTrans('projects.smart_filter.title')"
                    @click="isOpen ? close() : open()"
                >
                    <span class="smart-filter-fab-text">
                        <span class="smart-filter-fab-label">{{ getTrans("projects.smart_filter.title") }}</span>
                        <span class="smart-filter-fab-description">{{ getTrans("projects.smart_filter.description") }}</span>
                    </span>
                </button>

                <Transition name="smart-filter-popover">
                    <div v-if="isOpen" class="smart-filter-popover" role="dialog" aria-label="Smart filter">
                        <div class="smart-filter-popover-inner">
                            <p class="smart-filter-popover-hint">{{ getTrans("projects.smart_filter.popover_hint") }}</p>
                            <textarea
                                v-model="userInput"
                                class="smart-filter-input"
                                :placeholder="getTrans('projects.smart_filter.placeholder')"
                                :disabled="isLoading"
                                rows="3"
                                @keydown.enter.exact.prevent="handleSubmit"
                            />
                            <button
                                type="button"
                                class="smart-filter-submit"
                                :disabled="isLoading || !userInput.trim()"
                                @click="handleSubmit"
                            >
                                {{ isLoading ? "…" : getTrans("projects.smart_filter.button_label") }}
                            </button>
                            <p v-if="errorMessage" class="smart-filter-error">{{ getTrans(errorMessage as TranslationKey) }}</p>
                        </div>
                    </div>
                </Transition>
            </div>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/projects.css";
</style>
