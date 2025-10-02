<script setup lang="ts">
import CtaBlockComponent from "@components/cta-block-component.vue";
import {Link} from "@inertiajs/vue3";
import {ProjectInterface} from "@interfaces/ProjectInterface";
import DetailProjectController from "@actions/App/Http/Controllers/DetailProjectController";
import {useS3Image} from "@composables/useS3Image";

const props = defineProps<{
    projects: ProjectInterface[],
}>();
</script>
<template>
    <section class="section-website-our-projects">
        <div class="container">
            <div class="inner-container">
                <Link
                    v-for="project in props.projects"
                    :key="project.slug"
                    :href="DetailProjectController({
                    project: project,
                    })">
                    <cta-block-component
                        :title="project.name"
                        :subtitle="project.type"
                        :description="project.client.name"
                        :background-image="useS3Image(project.image) ?? ''"
                    ></cta-block-component>
                </Link>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/our-projects.css";
</style>
