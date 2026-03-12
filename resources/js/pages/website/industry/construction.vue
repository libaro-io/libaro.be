<script setup lang="ts">
import Website from "@layouts/website.vue";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import UspListComponent from "@components/usp-list-component.vue";
import Integrations from "@pages/website/expertise/sections/integrations.vue";
import CtaContact from "@pages/website/sections/cta-contact.vue";
import constructionHeader from "@assets/images/industries/construction.png";
import ChooseOdoo from "@assets/images/odoo/choose_odoo.webp";
import FinanceIcon from "@assets/images/odoo/icons/finance.png";
import ProductionIcon from "@assets/images/odoo/icons/production.png";
import ServicesIcon from "@assets/images/odoo/icons/services.png";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import {UspListInterface} from "@interfaces/UspListInterface";
import {IntegrationInterface} from "@interfaces/IntegrationInterface";

const whatWeDoBlock: ListWithImageInterface = {
    title: 'pages.construction_industry.what_we_do.title',
    descriptions: [
        'pages.construction_industry.what_we_do.descriptions.0',
        'pages.construction_industry.what_we_do.descriptions.1',
    ],
    listItems: [
        {
            title: 'pages.construction_industry.what_we_do.list_items.field_operations.title',
            description: 'pages.construction_industry.what_we_do.list_items.field_operations.description',
            image: ChooseOdoo,
        },
        {
            title: 'pages.construction_industry.what_we_do.list_items.planning_coordination.title',
            description: 'pages.construction_industry.what_we_do.list_items.planning_coordination.description',
            image: ChooseOdoo,
        },
        {
            title: 'pages.construction_industry.what_we_do.list_items.cost_control.title',
            description: 'pages.construction_industry.what_we_do.list_items.cost_control.description',
            image: ChooseOdoo,
        },
    ],
};

const howWeHelpBlock: UspListInterface = {
    title: 'pages.construction_industry.how_we_help.title',
    description: 'pages.construction_industry.how_we_help.description',
    listItems: [
        {
            title: 'pages.construction_industry.how_we_help.list_items.reduce_admin_work.title',
            description: 'pages.construction_industry.how_we_help.list_items.reduce_admin_work.description',
        },
        {
            title: 'pages.construction_industry.how_we_help.list_items.improve_site_visibility.title',
            description: 'pages.construction_industry.how_we_help.list_items.improve_site_visibility.description',
        },
        {
            title: 'pages.construction_industry.how_we_help.list_items.accelerate_billing.title',
            description: 'pages.construction_industry.how_we_help.list_items.accelerate_billing.description',
        },
        {
            title: 'pages.construction_industry.how_we_help.list_items.connect_existing_tools.title',
            description: 'pages.construction_industry.how_we_help.list_items.connect_existing_tools.description',
        },
    ],
};

const specializationList: IntegrationInterface[] = [
    {
        title: 'pages.construction_industry.specialization.list_items.robaws_and_erp_integrations.title',
        description: 'pages.construction_industry.specialization.list_items.robaws_and_erp_integrations.description',
        icon: FinanceIcon,
    },
    {
        title: 'pages.construction_industry.specialization.list_items.workforce_compliance.title',
        description: 'pages.construction_industry.specialization.list_items.workforce_compliance.description',
        icon: ProductionIcon,
    },
    {
        title: 'pages.construction_industry.specialization.list_items.field_to_office_data.title',
        description: 'pages.construction_industry.specialization.list_items.field_to_office_data.description',
        icon: ServicesIcon,
    },
];
</script>
<template>
    <website
        :margin-bottom="false"
        meta-key="construction_industry"
    >
        <div id="page-website-industry-construction" class="page-grid">
            <expertise-header
                title="pages.construction_industry.header.title"
                :description="[
                    'pages.construction_industry.header.description.0',
                    'pages.construction_industry.header.description.1'
                ]"
                :image="constructionHeader"
            ></expertise-header>

            <list-with-image-component
                :list-with-image="whatWeDoBlock"
                class="container"
                :is-clickable="false"
                :enable3d-effect="true"
            ></list-with-image-component>

            <usp-list-component
                :usp-list="howWeHelpBlock"
                :colored-background="true"
            ></usp-list-component>

            <integrations
                :integrations-list="specializationList"
                title="pages.construction_industry.specialization.title"
                description="pages.construction_industry.specialization.description"
                icon-size="small"
            ></integrations>

            <cta-contact
                title="pages.construction_industry.contact_form.title"
            ></cta-contact>
        </div>
    </website>
</template>
<style>
@import "@css/pages/website/industry/construction.css";
</style>
