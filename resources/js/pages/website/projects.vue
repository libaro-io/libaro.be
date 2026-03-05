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
const wrapperRef = ref<HTMLElement | null>(null);
const inputRef = ref<HTMLTextAreaElement | null>(null);

function handleClickOutside(event: MouseEvent): void {
    if (wrapperRef.value && !wrapperRef.value.contains(event.target as Node)) {
        close();
    }
}

watch(isOpen, (opened) => {
    if (opened) {
        nextTick(() => {
            document.addEventListener("click", handleClickOutside);
            inputRef.value?.focus();
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

function toggle(): void {
    if (isOpen.value) {
        close();
    } else {
        open();
    }
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
                <TransitionGroup name="project-card">
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
                </TransitionGroup>
            </card-list-component>

            <div v-if="hasActiveFilter && displayedProjects.length === 0" class="smart-filter-no-results">
                <h2 class="smart-filter-no-results-title">{{ getTrans("projects.smart_filter.no_results") }}</h2>
                <button type="button" class="smart-filter-no-results-clear" @click="clearFilter">
                    {{ getTrans("projects.smart_filter.clear") }}
                </button>
            </div>

            <div ref="wrapperRef" class="smart-filter-wrapper">
                <Transition name="smart-filter-summary">
                    <div v-if="hasActiveFilter && !isOpen" class="smart-filter-active-bar">
                        <p class="smart-filter-active-summary">{{ filterSummary }}</p>
                        <button type="button" class="smart-filter-active-clear" @click="clearFilter">
                            {{ getTrans("projects.smart_filter.clear") }}
                        </button>
                    </div>
                </Transition>

                <div class="smart-filter-pill" :class="{ 'is-expanded': isOpen, 'is-active': hasActiveFilter }">
                    <Transition name="smart-filter-panel" mode="out-in">
                        <button
                            v-if="!isOpen"
                            key="trigger"
                            type="button"
                            class="smart-filter-trigger"
                            :aria-label="getTrans('projects.smart_filter.title')"
                            @click="toggle"
                        >
                            <i class="fa-solid fa-wand-magic-sparkles smart-filter-trigger-icon" />
                            <span class="smart-filter-trigger-label">{{ getTrans("projects.smart_filter.title") }}</span>
                        </button>

                        <div v-else key="expanded" class="smart-filter-expanded">
                            <div class="smart-filter-expanded-header">
                                <span class="smart-filter-expanded-title">
                                    <i class="fa-solid fa-wand-magic-sparkles mr-2" />
                                    {{ getTrans("projects.smart_filter.title") }}
                                </span>
                                <button
                                    type="button"
                                    class="smart-filter-expanded-close"
                                    :aria-label="getTrans('projects.smart_filter.close')"
                                    @click="close"
                                >
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <textarea
                                ref="inputRef"
                                v-model="userInput"
                                class="smart-filter-input"
                                :placeholder="getTrans('projects.smart_filter.placeholder')"
                                :disabled="isLoading"
                                rows="2"
                                @keydown.enter.exact.prevent="handleSubmit"
                            />
                            <button
                                type="button"
                                class="smart-filter-submit"
                                :disabled="isLoading || !userInput.trim()"
                                @click="handleSubmit"
                            >
                                <span v-if="isLoading" class="smart-filter-spinner" />
                                <span v-else>{{ getTrans("projects.smart_filter.button_label") }}</span>
                            </button>
                        </div>
                    </Transition>

                    <p v-if="errorMessage" class="smart-filter-error">{{ getTrans(errorMessage as TranslationKey) }}</p>
                </div>
            </div>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/projects.css";
</style>
