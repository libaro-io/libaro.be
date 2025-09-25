<script setup lang="ts">
import Website from "@layouts/website.vue";
import {ProjectInterface} from "@interfaces/ProjectInterface";
import ContentBlock from "@pages/website/sections/content-block.vue";
import {useS3Image} from "@composables/useS3Image";
import {computed} from "vue";

const props = defineProps<{
    project: ProjectInterface
}>()

const hero = computed(() => {
    return props.project.image ? useS3Image(props.project.image) : null
})
</script>
<template>
    <website
        :page-title="props.project.name"
        :page-sub-title="props.project.type"
        :page-description="props.project.description"
        :header-options="{
            fullWidthDescription: true,
            background: hero
        }"
        :meta-title="props.project.name"
        :marginBottom="false">
        <div id="page-website-project">
            <content-block
                v-for="(block, index) in project.blocks" :key="index"
                :alt="project.name"
                :block="block"/>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/project.css";
</style>
