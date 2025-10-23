<script setup lang="ts">
import Website from "@layouts/website.vue";
import {ProjectInterface} from "@interfaces/ProjectInterface";
import ContentBlock from "@pages/website/sections/content-block.vue";
import ProjectIntro from "@pages/website/sections/project-intro.vue";
import {useS3Image} from "@composables/useS3Image";
import {computed} from "vue";
import {getTrans} from "@composables/UseTranslationHelper";
import LargeImageSubtitleComponent from "@components/large-image-subtitle-component.vue";
import ButtonComponent from "@components/button-component.vue";
import InterestingForYou from "@pages/website/sections/interesting-for-you.vue";
import {LandingPageInterface} from "@interfaces/LandingPageInterface";

const props = defineProps<{
    project: ProjectInterface,
    landingPages: LandingPageInterface[]
}>()

const hero = computed(() => {
    return props.project.image ? useS3Image(props.project.image) : null
})

const curiousAboutResultTitle = computed(() => {
    return props.project.client_url ? getTrans('projects.curious_result') : ''
});
</script>
<template>
    <website
        :page-title="props.project.name"
        :page-sub-title="props.project.type"
        :page-description="props.project.client?.name"
        :header-options="{
            tags: props.project.tags,
            whiteVariant: true,
        }"
        meta-key="projects"
        :meta-title-override="props.project.name"
        :meta-description-override="props.project.description"
        :marginBottom="false">
        <div id="page-website-project">
            <project-intro
                :project="props.project"/>

            <content-block
                v-for="(block, index) in project.blocks" :key="index"
                :alt="project.name"
                :block="block"/>

            <large-image-subtitle-component
                class="mt-10"
                :image="hero"
                :contain-image="true"
                :title="curiousAboutResultTitle"
                align="center"
            >
                <a
                    v-if="props.project.client_url"
                    :href="props.project.client_url"
                    target="_blank">
                    <button-component
                        :text="getTrans('projects.visit_application')"
                        color="tertiary"
                        size="large"
                        icon="fa-solid fa-chevron-right"
                    ></button-component>
                </a>
            </large-image-subtitle-component>

            <interesting-for-you
                :landing-pages="props.landingPages"
            ></interesting-for-you>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/project.css";
</style>
