<script setup lang="ts">
import Website from "@layouts/website.vue";
import {ProjectInterface} from "@interfaces/ProjectInterface";

const props = defineProps<{
    project: ProjectInterface
}>()
</script>
<template>
    <website
        :page-title="props.project.name"
        :page-sub-title="props.project.type"
        :page-description="props.project.description"
        :header-options="{ fullWidthDescription: true }"
        :meta-title="props.project.name"
        :marginBottom="false">
        <div id="page-website-project">
            page project
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/project.css";
</style>
