<script setup lang="ts">
import Website from "@layouts/website.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import {ProjectInterface} from "@interfaces/ProjectInterface";
import CardComponent from "@components/card-component.vue";

const props = defineProps<{
    projects: ProjectInterface[]
}>()
</script>
<template>
    <website
        :page-title="getTrans('projects.page_title')"
        :page-sub-title="getTrans('projects.page_sub_title')"
        :page-description="getTrans('projects.page_description')"
        :meta-title="getTrans('projects.meta_title')"
        :marginBottom="false">
        <div id="page-website-projects">
            <div class="container" id="project-list">
                <card-component
                    v-for="(project, index) in props.projects" :key="index"
                    :title="project.name"
                    :sub-title="project.client.name"
                    :category="project.type"
                ></card-component>
            </div>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/projects.css";
</style>
