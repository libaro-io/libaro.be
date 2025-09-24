<script setup lang="ts">
import Website from "@layouts/website.vue";
import {ProjectInterface} from "@interfaces/ProjectInterface";
import ContentBlock from "@pages/website/sections/content-block.vue";

const props = defineProps<{
    project: ProjectInterface
}>()
</script>
<template>
    <website
        :page-title="props.project.name"
        :page-sub-title="props.project.type"
        :page-description="props.project.description"
        :header-options="{
            fullWidthDescription: true,
            background: 'https://placehold.co/1500x1000'
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
