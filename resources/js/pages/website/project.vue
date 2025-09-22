<script setup lang="ts">
import Website from "@layouts/website.vue";
import {ProjectInterface} from "@interfaces/ProjectInterface";
import ProjectBlock from "@pages/website/sections/project-block.vue";

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
            <project-block
                v-for="(block, index) in project.blocks" :key="index"
                :project="project"
                :block="block"/>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/project.css";
</style>
