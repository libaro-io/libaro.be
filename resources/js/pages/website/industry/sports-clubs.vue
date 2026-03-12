<script setup lang="ts">
import Website from "@layouts/website.vue";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import UspListComponent from "@components/usp-list-component.vue";
import Integrations from "@pages/website/expertise/sections/integrations.vue";
import CtaContact from "@pages/website/sections/cta-contact.vue";
import sportsClubHeader from "@assets/images/industries/sports-club.png";
import ChooseOdoo from "@assets/images/odoo/choose_odoo.webp";
import SaleIcon from "@assets/images/odoo/icons/sale.png";
import ServicesIcon from "@assets/images/odoo/icons/services.png";
import MarketingIcon from "@assets/images/odoo/icons/marketing.png";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import {UspListInterface} from "@interfaces/UspListInterface";
import {IntegrationInterface} from "@interfaces/IntegrationInterface";

const whatWeDoBlock: ListWithImageInterface = {
    title: 'pages.sports_clubs_industry.what_we_do.title',
    descriptions: [
        'pages.sports_clubs_industry.what_we_do.descriptions.0',
        'pages.sports_clubs_industry.what_we_do.descriptions.1',
    ],
    listItems: [
        {
            title: 'pages.sports_clubs_industry.what_we_do.list_items.member_management.title',
            description: 'pages.sports_clubs_industry.what_we_do.list_items.member_management.description',
            image: ChooseOdoo,
        },
        {
            title: 'pages.sports_clubs_industry.what_we_do.list_items.ticketing_and_events.title',
            description: 'pages.sports_clubs_industry.what_we_do.list_items.ticketing_and_events.description',
            image: ChooseOdoo,
        },
        {
            title: 'pages.sports_clubs_industry.what_we_do.list_items.fan_communication.title',
            description: 'pages.sports_clubs_industry.what_we_do.list_items.fan_communication.description',
            image: ChooseOdoo,
        },
    ],
};

const howWeHelpBlock: UspListInterface = {
    title: 'pages.sports_clubs_industry.how_we_help.title',
    description: 'pages.sports_clubs_industry.how_we_help.description',
    listItems: [
        {
            title: 'pages.sports_clubs_industry.how_we_help.list_items.increase_member_engagement.title',
            description: 'pages.sports_clubs_industry.how_we_help.list_items.increase_member_engagement.description',
        },
        {
            title: 'pages.sports_clubs_industry.how_we_help.list_items.automate_back_office.title',
            description: 'pages.sports_clubs_industry.how_we_help.list_items.automate_back_office.description',
        },
        {
            title: 'pages.sports_clubs_industry.how_we_help.list_items.improve_staff_coordination.title',
            description: 'pages.sports_clubs_industry.how_we_help.list_items.improve_staff_coordination.description',
        },
        {
            title: 'pages.sports_clubs_industry.how_we_help.list_items.create_new_revenue_streams.title',
            description: 'pages.sports_clubs_industry.how_we_help.list_items.create_new_revenue_streams.description',
        },
    ],
};

const specializationList: IntegrationInterface[] = [
    {
        title: 'pages.sports_clubs_industry.specialization.list_items.ticketing_and_subscriptions.title',
        description: 'pages.sports_clubs_industry.specialization.list_items.ticketing_and_subscriptions.description',
        icon: SaleIcon,
    },
    {
        title: 'pages.sports_clubs_industry.specialization.list_items.member_portals.title',
        description: 'pages.sports_clubs_industry.specialization.list_items.member_portals.description',
        icon: ServicesIcon,
    },
    {
        title: 'pages.sports_clubs_industry.specialization.list_items.data_driven_operations.title',
        description: 'pages.sports_clubs_industry.specialization.list_items.data_driven_operations.description',
        icon: MarketingIcon,
    },
];

</script>
<template>
    <website
        :margin-bottom="false"
        meta-key="sports_clubs_industry"
    >
        <div id="page-website-industry-sports-clubs" class="page-grid">
            <expertise-header
                title="pages.sports_clubs_industry.header.title"
                :description="[
                    'pages.sports_clubs_industry.header.description.0',
                    'pages.sports_clubs_industry.header.description.1'
                ]"
                :image="sportsClubHeader"
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
                title="pages.sports_clubs_industry.specialization.title"
                description="pages.sports_clubs_industry.specialization.description"
                icon-size="small"
            ></integrations>

            <cta-contact
                title="pages.sports_clubs_industry.contact_form.title"
            ></cta-contact>
        </div>
    </website>
</template>
<style>
@import "@css/pages/website/industry/sports-clubs.css";
</style>
