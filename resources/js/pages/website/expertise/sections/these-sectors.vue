<script setup lang="ts">
import TitleComponent from "@components/title-component.vue";
import {ProjectInterface} from "@interfaces/ProjectInterface";
import CardComponent from "@components/card-component.vue";
import ProjectController from "@actions/App/Http/Controllers/ProjectController";
import DetailProjectController from "@actions/App/Http/Controllers/DetailProjectController";
import {useS3Image} from "@composables/useS3Image";
import SliderComponent from "@components/slider-component.vue";


const props = defineProps<{
    title: string;
    projects?: ProjectInterface[];
}>();

</script>
<template>
    <section class="section-website-expertise-these-sectors">
        <div class="container">
            <header>
                <title-component>
                    <h2>{{ props.title }}</h2>
                </title-component>
            </header>
            <div
                v-if="props.projects"
                class="projects">
                <slider-component>
                    <card-component
                        v-for="project in props.projects"
                        :title="project.name"
                        :image="useS3Image(project.image)"
                        :sub-title="project.client.name"
                        :has-shadow="false"
                        :scale-on-hover="false"
                        class="card-component"
                        :link="DetailProjectController({project: project.slug}).url"
                    ></card-component>
                </slider-component>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/expertise/sections/these-sectors.css";
</style>
