<script setup lang="ts">
import CtaBlockComponent from "@components/cta-block-component.vue";
import {Link} from "@inertiajs/vue3";
import {ProjectInterface} from "@interfaces/ProjectInterface";
import DetailProjectController from "@actions/App/Http/Controllers/DetailProjectController";
import {useS3Image} from "@composables/useS3Image";
import TitleComponent from "@components/title-component.vue";
import SubTitleComponent from "@components/sub-title-component.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import ButtonComponent from "@components/button-component.vue";
import ProjectController from "@actions/App/Http/Controllers/ProjectController";

const props = defineProps<{
    projects: ProjectInterface[],
}>();

</script>
<template>
    <section class="section-website-our-projects">
        <div class="container">
            <div class="titles">
                <title-component :has-margin="false">
                    <h2>
                        {{ getTrans('sections.our-projects.title') }}
                    </h2>
                </title-component>
                <sub-title-component :has-margin="false">
                    <h3>
                        {{ getTrans('sections.our-projects.subtitle') }}
                    </h3>
                </sub-title-component>
            </div>
            <div class="inner-container-our-projects">
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
            <div class="button">
                <Link :href="ProjectController()">
                    <button-component
                        :text="getTrans('sections.our-projects.button')"
                        color="tertiary"
                        size="large"
                        icon="fa-solid fa-chevron-right"
                    ></button-component>
                </Link>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/our-projects.css";
</style>
