<script setup lang="ts">
import Website from "@layouts/website.vue";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import UspListComponent from "@components/usp-list-component.vue";
import Integrations from "@pages/website/expertise/sections/integrations.vue";
import CtaContact from "@pages/website/sections/cta-contact.vue";
import wasteProcessingHeader from "@assets/images/industries/waste-management.png";
import ChooseOdoo from "@assets/images/odoo/choose_odoo.webp";
import ProductionIcon from "@assets/images/odoo/icons/production.png";
import FinanceIcon from "@assets/images/odoo/icons/finance.png";
import ServicesIcon from "@assets/images/odoo/icons/services.png";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import {UspListInterface} from "@interfaces/UspListInterface";
import {IntegrationInterface} from "@interfaces/IntegrationInterface";

const whatWeDoBlock: ListWithImageInterface = {
    title: 'pages.waste_processing_industry.what_we_do.title',
    descriptions: [
        'pages.waste_processing_industry.what_we_do.descriptions.0',
        'pages.waste_processing_industry.what_we_do.descriptions.1',
    ],
    listItems: [
        {
            title: 'pages.waste_processing_industry.what_we_do.list_items.operational_workflows.title',
            description: 'pages.waste_processing_industry.what_we_do.list_items.operational_workflows.description',
            image: ChooseOdoo,
        },
        {
            title: 'pages.waste_processing_industry.what_we_do.list_items.logistics_and_routes.title',
            description: 'pages.waste_processing_industry.what_we_do.list_items.logistics_and_routes.description',
            image: ChooseOdoo,
        },
        {
            title: 'pages.waste_processing_industry.what_we_do.list_items.compliance_reporting.title',
            description: 'pages.waste_processing_industry.what_we_do.list_items.compliance_reporting.description',
            image: ChooseOdoo,
        },
    ],
};

const howWeHelpBlock: UspListInterface = {
    title: 'pages.waste_processing_industry.how_we_help.title',
    description: 'pages.waste_processing_industry.how_we_help.description',
    listItems: [
        {
            title: 'pages.waste_processing_industry.how_we_help.list_items.improve_traceability.title',
            description: 'pages.waste_processing_industry.how_we_help.list_items.improve_traceability.description',
        },
        {
            title: 'pages.waste_processing_industry.how_we_help.list_items.reduce_manual_input.title',
            description: 'pages.waste_processing_industry.how_we_help.list_items.reduce_manual_input.description',
        },
        {
            title: 'pages.waste_processing_industry.how_we_help.list_items.optimize_capacity.title',
            description: 'pages.waste_processing_industry.how_we_help.list_items.optimize_capacity.description',
        },
        {
            title: 'pages.waste_processing_industry.how_we_help.list_items.support_regulatory_audits.title',
            description: 'pages.waste_processing_industry.how_we_help.list_items.support_regulatory_audits.description',
        },
    ],
};

const specializationList: IntegrationInterface[] = [
    {
        title: 'pages.waste_processing_industry.specialization.list_items.route_and_container_workflows.title',
        description: 'pages.waste_processing_industry.specialization.list_items.route_and_container_workflows.description',
        icon: ProductionIcon,
    },
    {
        title: 'pages.waste_processing_industry.specialization.list_items.compliance_and_reporting.title',
        description: 'pages.waste_processing_industry.specialization.list_items.compliance_and_reporting.description',
        icon: FinanceIcon,
    },
    {
        title: 'pages.waste_processing_industry.specialization.list_items.erp_and_weighbridge_integrations.title',
        description: 'pages.waste_processing_industry.specialization.list_items.erp_and_weighbridge_integrations.description',
        icon: ServicesIcon,
    },
];

</script>
<template>
    <website
        :margin-bottom="false"
        meta-key="waste_processing_industry"
    >
        <div id="page-website-industry-waste-processing" class="page-grid">
            <expertise-header
                title="pages.waste_processing_industry.header.title"
                :description="[
                    'pages.waste_processing_industry.header.description.0',
                    'pages.waste_processing_industry.header.description.1'
                ]"
                :image="wasteProcessingHeader"
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
                title="pages.waste_processing_industry.specialization.title"
                description="pages.waste_processing_industry.specialization.description"
                icon-size="small"
            ></integrations>

            <cta-contact
                title="pages.waste_processing_industry.contact_form.title"
            ></cta-contact>
        </div>
    </website>
</template>
<style>
@import "@css/pages/website/industry/waste-processing.css";
</style>
