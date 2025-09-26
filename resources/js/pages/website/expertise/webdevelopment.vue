<script setup lang="ts">
import Website from "@layouts/website.vue";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import UspListComponent from "@components/usp-list-component.vue";
import {UspListInterface} from "@interfaces/UspListInterface";

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

const uspListBlock: UspListInterface = {
    title: 'webdevelopment.usp_list.title',
    description: 'webdevelopment.usp_list.description',
    listItems: [
        {
            title: 'webdevelopment.usp_list.list_items.always_accessible.title',
            description: 'webdevelopment.usp_list.list_items.always_accessible.description',
        },
        {
            title: 'webdevelopment.usp_list.list_items.no_license_costs.title',
            description: 'webdevelopment.usp_list.list_items.no_license_costs.description',
        },
        {
            title: 'webdevelopment.usp_list.list_items.sme_scale.title',
            description: 'webdevelopment.usp_list.list_items.sme_scale.description',
        },
        {
            title: 'webdevelopment.usp_list.list_items.no_installation.title',
            description: 'webdevelopment.usp_list.list_items.no_installation.description',
        },
        {
            title: 'webdevelopment.usp_list.list_items.background_maintenance.title',
            description: 'webdevelopment.usp_list.list_items.background_maintenance.description',
        },
        {
            title: 'webdevelopment.usp_list.list_items.software_integration.title',
            description: 'webdevelopment.usp_list.list_items.software_integration.description',
        },
    ],
};

</script>
<template>

    <website>
        <div id="page-website-expertise-webdevelopment">
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
