<script setup lang="ts">
import Website from "@layouts/website.vue";
import {ProjectInterface} from "@interfaces/ProjectInterface";
import ContentBlock from "@pages/website/sections/content-block.vue";
import {useS3Image} from "@composables/useS3Image";
import {computed} from "vue";
import {getTrans} from "@composables/UseTranslationHelper";
import LargeImageSubtitleComponent from "@components/large-image-subtitle-component.vue";
import ButtonComponent from "@components/button-component.vue";

const props = defineProps<{
    project: ProjectInterface
}>()

const hero = computed(() => {
    return props.project.image ? useS3Image(props.project.image) : null
})

const visitLink = () => {
    if (!props.project.client_url) {
        return;
    }

    window.open(props.project.client_url, '_blank');
}
</script>
<template>
    <website
        :page-title="props.project.name"
        :page-sub-title="props.project.type"
        :page-description="props.project.description"
        :header-options="{
            fullWidthDescription: true,
            background: hero,
            tags: props.project.tags
        }"
        :meta-title="props.project.name"
        :marginBottom="false">
        <div id="page-website-project">
            <content-block
                v-for="(block, index) in project.blocks" :key="index"
                :alt="project.name"
                :block="block"/>

            <large-image-subtitle-component
                v-if="props.project.client_url"
                class="mt-10"
                :image="hero"
                :title="getTrans('projects.curious_result')"
                align="center"
            >
                <button-component
                    v-if="props.project.client_url"
                    @click="visitLink"
                    :text="getTrans('projects.visit_application')"
                    color="tertiary"
                    size="large"
                    icon="fa-solid fa-chevron-right"
                ></button-component>
            </large-image-subtitle-component>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/project.css";
</style>
