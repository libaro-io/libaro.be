<script setup lang="ts">
import Website from "@layouts/website.vue";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import UspListComponent from "@components/usp-list-component.vue";
import {UspListInterface} from "@interfaces/UspListInterface";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import {ClientInterface} from "@interfaces/ClientInterface";
import OurClients from "@pages/website/sections/our-clients.vue";

const props = defineProps<{
    clients: ClientInterface[];
}>();

const conceptToWebApplicationBlock: ListWithImageInterface = {
    title: 'pages.webdevelopment.concept_to_web_application.title',
    descriptions: [
        'pages.webdevelopment.concept_to_web_application.descriptions.0',
        'pages.webdevelopment.concept_to_web_application.descriptions.1'
    ],
    listItems: [
        {
            title: 'pages.webdevelopment.concept_to_web_application.list_items.strategy_analysis.title',
            description: 'pages.webdevelopment.concept_to_web_application.list_items.strategy_analysis.description',
            image: 'https://placehold.co/400x400'
        },
        {
            title: 'pages.webdevelopment.concept_to_web_application.list_items.ux_ui_design.title',
            description: 'pages.webdevelopment.concept_to_web_application.list_items.ux_ui_design.description',
            image: 'https://placehold.co/200x400'
        },
        {
            title: 'pages.webdevelopment.concept_to_web_application.list_items.development_testing.title',
            description: 'pages.webdevelopment.concept_to_web_application.list_items.development_testing.description',
            image: 'https://placehold.co/500x400'
        }
    ]
}

const uspListBlock: UspListInterface = {
    title: 'pages.webdevelopment.usp_list.title',
    description: 'pages.webdevelopment.usp_list.description',
    listItems: [
        {
            title: 'pages.webdevelopment.usp_list.list_items.always_accessible.title',
            description: 'pages.webdevelopment.usp_list.list_items.always_accessible.description',
        },
        {
            title: 'pages.webdevelopment.usp_list.list_items.no_license_costs.title',
            description: 'pages.webdevelopment.usp_list.list_items.no_license_costs.description',
        },
        {
            title: 'pages.webdevelopment.usp_list.list_items.sme_scale.title',
            description: 'pages.webdevelopment.usp_list.list_items.sme_scale.description',
        },
        {
            title: 'pages.webdevelopment.usp_list.list_items.no_installation.title',
            description: 'pages.webdevelopment.usp_list.list_items.no_installation.description',
        },
        {
            title: 'pages.webdevelopment.usp_list.list_items.background_maintenance.title',
            description: 'pages.webdevelopment.usp_list.list_items.background_maintenance.description',
        },
        {
            title: 'pages.webdevelopment.usp_list.list_items.software_integration.title',
            description: 'pages.webdevelopment.usp_list.list_items.software_integration.description',
        },
    ],
};

</script>
<template>

    <website :margin-bottom="false">
        <div id="page-website-expertise-webdevelopment">
            <expertise-header
                title="pages.webdevelopment.header.title"
                description="pages.webdevelopment.header.description"
                image="https://placehold.co/400x400"
            ></expertise-header>
            <our-clients
                :clients="clients"
            ></our-clients>
            <list-with-image-component
                :list-with-image="conceptToWebApplicationBlock"
                class="container"
            ></list-with-image-component>
            <usp-list-component
                :usp-list="uspListBlock"
                class="container"
            ></usp-list-component>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/expertise/webdevelopment.css";
</style>
