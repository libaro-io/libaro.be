<script setup lang="ts">
import Website from "@layouts/website.vue";
import CtaContact from "@pages/website/sections/cta-contact.vue";
import OurClients from "@pages/website/sections/our-clients.vue";
import {PaginationInterface} from "@interfaces/PaginationInterface";
import {ClientInterface} from "@interfaces/ClientInterface";
import TextBlockImageComponent from "@components/text-block-image-component.vue";
import {TextBlockImageInterface} from "@interfaces/TextBlockImageInterface";

const props = defineProps<{
    clients?: PaginationInterface<ClientInterface[]>
}>();

const textBlockImage: TextBlockImageInterface = {
    subTitle: 'sections.home.text-block-image.subtitle',
    title: 'sections.home.text-block-image.title',
    texts: [
        'sections.home.text-block-image.texts.0',
        'sections.home.text-block-image.texts.1',
    ]
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
                :clients="props.clients"></our-clients>
            <cta-contact></cta-contact>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/home.css";
</style>
