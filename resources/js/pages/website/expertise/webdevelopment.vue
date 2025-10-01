<script setup lang="ts">
import Website from "@layouts/website.vue";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import UspListComponent from "@components/usp-list-component.vue";
import {UspListInterface} from "@interfaces/UspListInterface";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import {ClientInterface} from "@interfaces/ClientInterface";
import OurClients from "@pages/website/sections/our-clients.vue";
import OurTools from "@pages/website/expertise/sections/our-tools.vue";
import {ToolInterface} from "@interfaces/ToolInterface";
import {getTrans} from "@composables/UseTranslationHelper";
import CheckInAtWork from "@assets/tools/checkinatwork.png";
import Clearfacts from "@assets/tools/clearfacts.png";
import Odoo from "@assets/tools/odoo.png";
import Officient from "@assets/tools/officient.png";
import Robaws from "@assets/tools/robaws.png";
import Sharepoint from "@assets/tools/sharepoint.webp";
import TheseSectors from "@pages/website/expertise/sections/these-sectors.vue";
import {ProjectInterface} from "@interfaces/ProjectInterface";

const props = defineProps<{
    clients: ClientInterface[];
    projects?: ProjectInterface[];
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

const ourToolsBlocks: ToolInterface[] = [
    {
        image: CheckInAtWork,
        name: 'Checkin@work',
        description: 'pages.webdevelopment.our_tools.tools.checkin_at_work.description',
    },
    {
        image: Clearfacts,
        name: 'Clearfacts',
        description: 'pages.webdevelopment.our_tools.tools.clearfacts.description',
    },
    {
        image: Odoo,
        name: 'Odoo',
        description: 'pages.webdevelopment.our_tools.tools.odoo.description',
    },
    {
        image: Officient,
        name: 'Officient',
        description: 'pages.webdevelopment.our_tools.tools.officient.description',
    },
    {
        image: Robaws,
        name: 'Robaws',
        description: 'pages.webdevelopment.our_tools.tools.robaws.description',
    },
    {
        image: Sharepoint,
        name: 'Sharepoint',
        description: 'pages.webdevelopment.our_tools.tools.sharepoint.description',
    }
]

</script>
<template>
    {{}}
    <website
        :meta-title="getTrans('pages.webdevelopment.meta_title')"
        :margin-bottom="false">
        <div id="page-website-expertise-webdevelopment">
            <expertise-header
                title="pages.webdevelopment.header.title"
                description="pages.webdevelopment.header.description"
                image="https://placehold.co/400x400"
            ></expertise-header>
            <our-clients
                :clients="props.clients"
            ></our-clients>
            <list-with-image-component
                :list-with-image="conceptToWebApplicationBlock"
                class="container"
            ></list-with-image-component>
            <these-sectors
                :title="getTrans('pages.webdevelopment.these_sectors.title')"
                :projects="props.projects"
            ></these-sectors>
            <usp-list-component
                :usp-list="uspListBlock"
                class="container"
            ></usp-list-component>
            <our-tools
                :our-tools="ourToolsBlocks"
            ></our-tools>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/expertise/webdevelopment.css";
</style>
