<script setup lang="ts">
import Website from "@layouts/website.vue";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import aiHeader from "@assets/images/ai/header.jpg";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import ChooseAI from "@assets/images/ai/choose_ai.png"
import UspListComponent from "@components/usp-list-component.vue";
import {UspListInterface} from "@interfaces/UspListInterface";
import CtaContact from "@pages/website/sections/cta-contact.vue";

const WhatIsAIForYou: ListWithImageInterface = {
    title: 'pages.ai.what_is_ai_for_you.title',
    descriptions: [
        'pages.ai.what_is_ai_for_you.description'
    ],
    listItems: [
        {
            title: 'pages.ai.what_is_ai_for_you.list_items.consultancy_training.title',
            description: 'pages.ai.what_is_ai_for_you.list_items.consultancy_training.description',
            image: ChooseAI
        },
        {
            title: 'pages.ai.what_is_ai_for_you.list_items.product_development.title',
            description: 'pages.ai.what_is_ai_for_you.list_items.product_development.description',
            image: ChooseAI
        },
        {
            title: 'pages.ai.what_is_ai_for_you.list_items.gpt_integrations.title',
            description: 'pages.ai.what_is_ai_for_you.list_items.gpt_integrations.description',
            image: ChooseAI
        },
        {
            title: 'pages.ai.what_is_ai_for_you.list_items.workflow_automation.title',
            description: 'pages.ai.what_is_ai_for_you.list_items.workflow_automation.description',
            image: ChooseAI
        }
    ]
};

const uspListBlock: UspListInterface = {
    title: 'pages.ai.strategic_advantages.title',
    description: 'pages.ai.strategic_advantages.description',
    listItems: [
        {
            title: 'pages.ai.strategic_advantages.list_items.customer_service.title',
            description: 'pages.ai.strategic_advantages.list_items.customer_service.description',
        },
        {
            title: 'pages.ai.strategic_advantages.list_items.human_resources.title',
            description: 'pages.ai.strategic_advantages.list_items.human_resources.description',
        },
        {
            title: 'pages.ai.strategic_advantages.list_items.internal_knowledge.title',
            description: 'pages.ai.strategic_advantages.list_items.internal_knowledge.description',
        },
        {
            title: 'pages.ai.strategic_advantages.list_items.sales.title',
            description: 'pages.ai.strategic_advantages.list_items.sales.description',
        },
        {
            title: 'pages.ai.strategic_advantages.list_items.data_analysis.title',
            description: 'pages.ai.strategic_advantages.list_items.data_analysis.description',
        },
    ],
};

</script>
<template>
    <website
        :margin-bottom="false"
        meta-key="ai_integrations_expertise">
        <div id="page-website-expertise-ai-integrations" class="page-grid">
            <expertise-header
                title="pages.ai.header.title"
                :description="[
                    'pages.ai.header.description.0',
                    'pages.ai.header.description.1'
                ]"
                :image="aiHeader"
            ></expertise-header>

            <list-with-image-component
                :list-with-image="WhatIsAIForYou"
                class="container"
                :is-clickable="false"
                :enable3d-effect="true"
            ></list-with-image-component>

            <usp-list-component
                :usp-list="uspListBlock"
                :colored-background="true"
            ></usp-list-component>

            <cta-contact
                title="pages.ai.contact_form.title"
                :negative-margin="true"
            ></cta-contact>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/expertise/ai-integrations.css";
</style>
