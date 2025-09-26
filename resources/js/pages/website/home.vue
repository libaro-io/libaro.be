<script setup lang="ts">
import Website from "@layouts/website.vue";
import CtaContact from "@pages/website/sections/cta-contact.vue";
import OurClients from "@pages/website/sections/our-clients.vue";
import { PaginationInterface } from "@interfaces/PaginationInterface";
import { ClientInterface } from "@interfaces/ClientInterface";
import TextBlockImageComponent from "@components/text-block-image-component.vue";
import { TextBlockImageInterface } from "@interfaces/TextBlockImageInterface";
import defaultHomeImage from "@assets/images/strategy_1_584.webp";
import landingPageHomeImage1 from "@assets/images/libaro-team_1.webp";
import landingPageHomeImage2 from "@assets/images/libaro-team_2.webp";
import landingPageHomeImage3 from "@assets/images/libaro-team_3.webp";
import landingPageHomeImage4 from "@assets/images/libaro-team_4.webp";
import landingPageHomeImage5 from "@assets/images/libaro-team_5.webp";
import landingPageHomeImage6 from "@assets/images/libaro-team_6.webp";
import landingPageHomeImage7 from "@assets/images/libaro-team_7.webp";
import landingPageHomeImage8 from "@assets/images/libaro-team_8.webp";
import landingPageHomeImage9 from "@assets/images/libaro-team_9.webp";
import landingPageHomeImage10 from "@assets/images/libaro-team_10.webp";
import landingPageHomeImage11 from "@assets/images/libaro-team_11.webp";
import landingPageHomeImage12 from "@assets/images/libaro-team_12.webp";
import landingPageHomeImage13 from "@assets/images/libaro-team_13.webp";
import landingPageHomeImage14 from "@assets/images/libaro-team_14.webp";
import OurProjects from "@pages/website/sections/our-projects.vue";
import { ProjectInterface } from "@interfaces/ProjectInterface";
import { getTrans } from "@composables/UseTranslationHelper";
import { LandingPageInterface } from "@interfaces/LandingPageInterface";
import { computed } from "vue";

const props = defineProps<{
    clients?: PaginationInterface<ClientInterface[]>;
    projects: ProjectInterface[];
    landingPage?: LandingPageInterface;
}>();

const homeImage = computed(() => {
    if (props.landingPage) {
        const imgs = [
            landingPageHomeImage1,
            landingPageHomeImage2,
            landingPageHomeImage3,
            landingPageHomeImage4,
            landingPageHomeImage5,
            landingPageHomeImage6,
            landingPageHomeImage7,
            landingPageHomeImage8,
            landingPageHomeImage9,
            landingPageHomeImage10,
            landingPageHomeImage11,
            landingPageHomeImage12,
            landingPageHomeImage13,
            landingPageHomeImage14,
        ];
        return imgs[props.landingPage?.block?.image_index - 1];
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
        <div id="page-website-home">
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
