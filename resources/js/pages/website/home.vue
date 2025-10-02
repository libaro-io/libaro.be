<script setup lang="ts">
import Website from "@layouts/website.vue";
import CtaContact from "@pages/website/sections/cta-contact.vue";
import OurClients from "@pages/website/sections/our-clients.vue";
import { PaginationInterface } from "@interfaces/PaginationInterface";
import { ClientInterface } from "@interfaces/ClientInterface";
import TextBlockImageComponent from "@components/text-block-image-component.vue";
import { TextBlockImageInterface } from "@interfaces/TextBlockImageInterface";
import defaultHomeImage from "@assets/images/strategy_1_584.webp";

import OurProjects from "@pages/website/sections/our-projects.vue";
import { ProjectInterface } from "@interfaces/ProjectInterface";
import { getTrans } from "@composables/UseTranslationHelper";
import { LandingPageInterface } from "@interfaces/LandingPageInterface";
import { computed } from "vue";
import {getLandingPageImage} from "@composables/UseLandingPageImage";

const props = defineProps<{
    clients?: PaginationInterface<ClientInterface[]>;
    projects: ProjectInterface[];
    landingPage?: LandingPageInterface;
}>();

const homeImage = computed(() => {
    if (props.landingPage) {
       return getLandingPageImage(props.landingPage?.block?.image_index)
    }
    return defaultHomeImage;
});

const textBlockImage = computed<TextBlockImageInterface>(() => {
    if (props.landingPage) {
        return {
            subTitle: props.landingPage.block.subtitle,
            title: props.landingPage.block.title,
            texts: [props.landingPage.block.text],
            image: homeImage.value,
        };
    }

    return {
        subTitle: getTrans("pages.home.text-block-image.subtitle"),
        title: getTrans("pages.home.text-block-image.title"),
        texts: [
            getTrans("pages.home.text-block-image.texts.0"),
            getTrans("pages.home.text-block-image.texts.1"),
        ],
        image: homeImage.value,
    };
});

const pageTitle = computed(
    () => props.landingPage?.title ?? getTrans("pages.home.header.title")
);
const metaTitle = computed(
    () => props.landingPage?.title ?? getTrans("pages.home.title")
);

const projects = computed(() => props.landingPage?.projects ?? props.projects);
</script>
<template>
    <website
        :margin-bottom="false"
        :header-options="{
            isHome: true,
            fullWidthDescription: true,
        }"
        :page-title="pageTitle"
        :page-description="getTrans('pages.home.header.description')"
        :meta-title="metaTitle"
    >
        <div id="page-website-home" class="page-grid">
            <our-projects :projects="projects"></our-projects>
            <text-block-image-component
                class="container"
                :text-block-image="textBlockImage"
                image-side="right"
            ></text-block-image-component>
            <our-clients :clients="props.clients"></our-clients>
            <cta-contact></cta-contact>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/home.css";
</style>
