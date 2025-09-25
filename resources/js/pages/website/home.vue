<script setup lang="ts">
import Website from "@layouts/website.vue";
import CtaContact from "@pages/website/sections/cta-contact.vue";
import OurClients from "@pages/website/sections/our-clients.vue";
import {PaginationInterface} from "@interfaces/PaginationInterface";
import {ClientInterface} from "@interfaces/ClientInterface";
import TextBlockImageComponent from "@components/text-block-image-component.vue";
import {TextBlockImageInterface} from "@interfaces/TextBlockImageInterface";
import homeImage from "@assets/images/strategy_1_584.webp";

const props = defineProps<{
    clients?: PaginationInterface<ClientInterface[]>
}>();

const textBlockImage: TextBlockImageInterface = {
    subTitle: 'pages.home.text-block-image.subtitle',
    title: 'pages.home.text-block-image.title',
    texts: [
        'pages.home.text-block-image.texts.0',
        'pages.home.text-block-image.texts.1',
    ],
    image: homeImage,
}

</script>
<template>
    <website meta-title="Digital Innovation Partner">
        <div id="page-website-home">
            <text-block-image-component
                class="container"
                :text-block-image="textBlockImage"
                image-side="right"
            ></text-block-image-component>
            <our-clients
                :clients="props.clients"
            ></our-clients>
            <cta-contact></cta-contact>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/home.css";
</style>
