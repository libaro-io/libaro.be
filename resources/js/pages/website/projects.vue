<script setup lang="ts">
import Website from "@layouts/website.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import {ProjectInterface} from "@interfaces/ProjectInterface";
import CardComponent from "@components/card-component.vue";
import CardListComponent from "@components/card-list-component.vue";
import DetailProjectController from "@actions/App/Http/Controllers/DetailProjectController";

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
            <card-list-component>
                <card-component
                    v-for="(project, index) in props.projects" :key="index"
                    :link="DetailProjectController({project: project.slug}).url"
                    :title="project.name"
                    :sub-title="project.client.name"
                    :category="project.type"
                ></card-component>
            </card-list-component>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/projects.css";
</style>
