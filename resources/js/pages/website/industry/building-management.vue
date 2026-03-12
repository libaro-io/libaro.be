<script setup lang="ts">
import Website from "@layouts/website.vue";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import UspListComponent from "@components/usp-list-component.vue";
import Integrations from "@pages/website/expertise/sections/integrations.vue";
import CtaContact from "@pages/website/sections/cta-contact.vue";
import smartBuildingHeader from "@assets/images/industries/smart-house.png";
import ChooseOdoo from "@assets/images/odoo/choose_odoo.webp";
import ProductionIcon from "@assets/images/odoo/icons/production.png";
import ServicesIcon from "@assets/images/odoo/icons/services.png";
import FinanceIcon from "@assets/images/odoo/icons/finance.png";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import {UspListInterface} from "@interfaces/UspListInterface";
import {IntegrationInterface} from "@interfaces/IntegrationInterface";

const whatWeDoBlock: ListWithImageInterface = {
    title: 'pages.building_management_industry.what_we_do.title',
    descriptions: [
        'pages.building_management_industry.what_we_do.descriptions.0',
        'pages.building_management_industry.what_we_do.descriptions.1',
    ],
    listItems: [
        {
            title: 'pages.building_management_industry.what_we_do.list_items.maintenance_and_work_orders.title',
            description: 'pages.building_management_industry.what_we_do.list_items.maintenance_and_work_orders.description',
            image: ChooseOdoo,
        },
        {
            title: 'pages.building_management_industry.what_we_do.list_items.incident_and_service_requests.title',
            description: 'pages.building_management_industry.what_we_do.list_items.incident_and_service_requests.description',
            image: ChooseOdoo,
        },
        {
            title: 'pages.building_management_industry.what_we_do.list_items.building_performance_dashboards.title',
            description: 'pages.building_management_industry.what_we_do.list_items.building_performance_dashboards.description',
            image: ChooseOdoo,
        },
    ],
};

const howWeHelpBlock: UspListInterface = {
    title: 'pages.building_management_industry.how_we_help.title',
    description: 'pages.building_management_industry.how_we_help.description',
    listItems: [
        {
            title: 'pages.building_management_industry.how_we_help.list_items.shorten_resolution_times.title',
            description: 'pages.building_management_industry.how_we_help.list_items.shorten_resolution_times.description',
        },
        {
            title: 'pages.building_management_industry.how_we_help.list_items.lower_operational_costs.title',
            description: 'pages.building_management_industry.how_we_help.list_items.lower_operational_costs.description',
        },
        {
            title: 'pages.building_management_industry.how_we_help.list_items.improve_tenant_experience.title',
            description: 'pages.building_management_industry.how_we_help.list_items.improve_tenant_experience.description',
        },
        {
            title: 'pages.building_management_industry.how_we_help.list_items.centralize_operational_control.title',
            description: 'pages.building_management_industry.how_we_help.list_items.centralize_operational_control.description',
        },
    ],
};

const specializationList: IntegrationInterface[] = [
    {
        title: 'pages.building_management_industry.specialization.list_items.iot_and_sensor_integrations.title',
        description: 'pages.building_management_industry.specialization.list_items.iot_and_sensor_integrations.description',
        icon: ProductionIcon,
    },
    {
        title: 'pages.building_management_industry.specialization.list_items.maintenance_and_contractor_workflows.title',
        description: 'pages.building_management_industry.specialization.list_items.maintenance_and_contractor_workflows.description',
        icon: ServicesIcon,
    },
    {
        title: 'pages.building_management_industry.specialization.list_items.energy_access_and_comfort_intelligence.title',
        description: 'pages.building_management_industry.specialization.list_items.energy_access_and_comfort_intelligence.description',
        icon: FinanceIcon,
    },
];

</script>
<template>
    <website
        :margin-bottom="false"
        meta-key="building_management_industry"
    >
        <div id="page-website-industry-building-management" class="page-grid">
            <expertise-header
                title="pages.building_management_industry.header.title"
                :description="[
                    'pages.building_management_industry.header.description.0',
                    'pages.building_management_industry.header.description.1'
                ]"
                :image="smartBuildingHeader"
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
                title="pages.building_management_industry.specialization.title"
                description="pages.building_management_industry.specialization.description"
                icon-size="small"
            ></integrations>

            <cta-contact
                title="pages.building_management_industry.contact_form.title"
            ></cta-contact>
        </div>
    </website>
</template>
<style>
@import "@css/pages/website/industry/building-management.css";
</style>
