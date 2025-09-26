<script setup lang="ts">
import Website from "@layouts/website.vue";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";

const conceptToWebApplicationBlock: ListWithImageInterface = {
    title: 'webdevelopment.concept_to_web_application.title',
    descriptions: [
        'webdevelopment.concept_to_web_application.descriptions.0',
        'webdevelopment.concept_to_web_application.descriptions.1'
    ],
    listItems: [
        {
            title: 'webdevelopment.concept_to_web_application.list_items.strategy_analysis.title',
            description: 'webdevelopment.concept_to_web_application.list_items.strategy_analysis.description',
            image: 'https://placehold.co/400x400'
        },
        {
            title: 'webdevelopment.concept_to_web_application.list_items.ux_ui_design.title',
            description: 'webdevelopment.concept_to_web_application.list_items.ux_ui_design.description',
            image: 'https://placehold.co/200x400'
        },
        {
            title: 'webdevelopment.concept_to_web_application.list_items.development_testing.title',
            description: 'webdevelopment.concept_to_web_application.list_items.development_testing.description',
            image: 'https://placehold.co/500x400'
        }
    ]
}

</script>
<template>

    <website>
        <div id="page-website-expertise-webdevelopment">
            <list-with-image-component
                :list-with-image="conceptToWebApplicationBlock"
                class="container"
            ></list-with-image-component>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/expertise/webdevelopment.css";
</style>
