<script setup lang="ts">
import Website from "@layouts/website.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import appsHeader from "@assets/images/apps/header.png";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import conceptToAppsImage from "@assets/images/apps/concept_to_apps.png";
import TheseSectors from "@pages/website/expertise/sections/these-sectors.vue";
import {ProjectInterface} from "@interfaces/ProjectInterface";
import UspListComponent from "@components/usp-list-component.vue";
import {UspListInterface} from "@interfaces/UspListInterface";
import OurTools from "@pages/website/expertise/sections/our-tools.vue";
import {ToolInterface} from "@interfaces/ToolInterface";
import CheckInAtWork from "@assets/tools/checkinatwork.png";
import Clearfacts from "@assets/tools/clearfacts.png";
import Odoo from "@assets/tools/odoo.png";
import Officient from "@assets/tools/officient.png";
import Robaws from "@assets/tools/robaws.png";
import Sharepoint from "@assets/tools/sharepoint.webp";
import ContactForm from "@pages/website/sections/contact-form.vue";

const props = defineProps<{
    projects?: ProjectInterface[];
}>();

const conceptToAppsBlock: ListWithImageInterface = {
    title: 'pages.apps.concept_to_apps.title',
    descriptions: [
        'pages.apps.concept_to_apps.descriptions.0',
        'pages.apps.concept_to_apps.descriptions.1'
    ],
    listItems: [
        {
            title: 'pages.apps.concept_to_apps.list_items.strategy_analysis.title',
            description: 'pages.apps.concept_to_apps.list_items.strategy_analysis.description',
            image: conceptToAppsImage
        },
        {
            title: 'pages.apps.concept_to_apps.list_items.ux_ui_design.title',
            description: 'pages.apps.concept_to_apps.list_items.ux_ui_design.description',
            image: conceptToAppsImage
        },
        {
            title: 'pages.apps.concept_to_apps.list_items.development_testing.title',
            description: 'pages.apps.concept_to_apps.list_items.development_testing.description',
            image: conceptToAppsImage
        }
    ]
}

const uspListBlock: UspListInterface = {
    title: 'pages.apps.strategic_advantages.title',
    description: 'pages.apps.strategic_advantages.description',
    listItems: [
        {
            title: 'pages.apps.strategic_advantages.list_items.direct_communication.title',
            description: 'pages.apps.strategic_advantages.list_items.direct_communication.description',
        },
        {
            title: 'pages.apps.strategic_advantages.list_items.user_engagement.title',
            description: 'pages.apps.strategic_advantages.list_items.user_engagement.description',
        },
        {
            title: 'pages.apps.strategic_advantages.list_items.process_optimization.title',
            description: 'pages.apps.strategic_advantages.list_items.process_optimization.description',
        },
        {
            title: 'pages.apps.strategic_advantages.list_items.improved_service.title',
            description: 'pages.apps.strategic_advantages.list_items.improved_service.description',
        },
        {
            title: 'pages.apps.strategic_advantages.list_items.new_value_channels.title',
            description: 'pages.apps.strategic_advantages.list_items.new_value_channels.description',
        },
    ],
};

const ourToolsBlocks: ToolInterface[] = [
    {
        image: CheckInAtWork,
        name: 'Checkin@work',
        description: 'pages.apps.our_tools.tools.checkin_at_work.description',
    },
    {
        image: Clearfacts,
        name: 'Clearfacts',
        description: 'pages.apps.our_tools.tools.clearfacts.description',
    },
    {
        image: Odoo,
        name: 'Odoo',
        description: 'pages.apps.our_tools.tools.odoo.description',
    },
    {
        image: Officient,
        name: 'Officient',
        description: 'pages.apps.our_tools.tools.officient.description',
    },
    {
        image: Robaws,
        name: 'Robaws',
        description: 'pages.apps.our_tools.tools.robaws.description',
    },
    {
        image: Sharepoint,
        name: 'Sharepoint',
        description: 'pages.apps.our_tools.tools.sharepoint.description',
    }
]


</script>
<template>
    <website
        :margin-bottom="false"
        meta-key="apps_expertise"
    >
    <div id="page-website-expertise-apps" class="page-grid">
        <expertise-header
            title="pages.apps.header.title"
            description="pages.apps.header.description"
            :image="appsHeader"
        ></expertise-header>

        <list-with-image-component
            :list-with-image="conceptToAppsBlock"
            class="container"
            :is-clickable="false"
            :enable3d-effect="true"
        ></list-with-image-component>

        <usp-list-component
            :usp-list="uspListBlock"
            :colored-background="true"
        ></usp-list-component>

        <these-sectors
            :title="getTrans('pages.apps.these_sectors.title')"
            :projects="props.projects"
        ></these-sectors>

        <our-tools
            title="pages.apps.our_tools.title"
            :our-tools="ourToolsBlocks"
            :colored-background="true"
        ></our-tools>

        <contact-form
            :title="getTrans('pages.apps.contact_form.title')"
            class="container">
        </contact-form>
    </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/expertise/apps.css";
</style>
