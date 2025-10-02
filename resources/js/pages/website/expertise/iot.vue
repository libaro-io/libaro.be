<script setup lang="ts">
import Website from "@layouts/website.vue";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import iotHeader from "@assets/images/iot/header.png";
import {getTrans} from "@composables/UseTranslationHelper";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import conceptToIOTImage from "@assets/images/iot/concept_to_iot.png";

const conceptToAppsBlock: ListWithImageInterface = {
    title: 'pages.iot.how_it_works.title',
    descriptions: [
        'pages.iot.how_it_works.descriptions.0',
    ],
    listItems: [
        {
            title: 'pages.iot.how_it_works.list_items.strategy_analysis.title',
            description: 'pages.iot.how_it_works.list_items.strategy_analysis.description',
            image: conceptToIOTImage,
            badges: [
                'pages.iot.how_it_works.list_items.strategy_analysis.badges.0',
                'pages.iot.how_it_works.list_items.strategy_analysis.badges.1',
                'pages.iot.how_it_works.list_items.strategy_analysis.badges.2',
                'pages.iot.how_it_works.list_items.strategy_analysis.badges.3'
            ]
        },
        {
            title: 'pages.iot.how_it_works.list_items.custom_design.title',
            description: 'pages.iot.how_it_works.list_items.custom_design.description',
            image: conceptToIOTImage,
            badges: [
                'pages.iot.how_it_works.list_items.custom_design.badges.0',
                'pages.iot.how_it_works.list_items.custom_design.badges.1',
                'pages.iot.how_it_works.list_items.custom_design.badges.2',
                'pages.iot.how_it_works.list_items.custom_design.badges.3'
            ]
        },
        {
            title: 'pages.iot.how_it_works.list_items.implementation_support.title',
            description: 'pages.iot.how_it_works.list_items.implementation_support.description',
            image: conceptToIOTImage,
            badges: [
                'pages.iot.how_it_works.list_items.implementation_support.badges.0',
                'pages.iot.how_it_works.list_items.implementation_support.badges.1',
                'pages.iot.how_it_works.list_items.implementation_support.badges.2',
                'pages.iot.how_it_works.list_items.implementation_support.badges.3',
                'pages.iot.how_it_works.list_items.implementation_support.badges.4'
            ]
        }
    ]
}

</script>
<template>
    <website
        :margin-bottom="false"
        :meta-title="getTrans('pages.iot.meta_title')"
    >
        <div id="page-website-expertise-iot" class="page-grid">
            <expertise-header
                title="pages.iot.header.title"
                description="pages.iot.header.description"
                :image="iotHeader"
            ></expertise-header>
            <list-with-image-component
                :list-with-image="conceptToAppsBlock"
                class="container"
                :is-clickable="false"
            ></list-with-image-component>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/expertise/iot.css";
</style>
