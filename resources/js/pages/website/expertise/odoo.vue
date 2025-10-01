<script setup lang="ts">
import Website from "@layouts/website.vue";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import odooHeader from "@assets/images/odoo/header.gif";
import {getTrans} from "@composables/UseTranslationHelper";
import OurClients from "@pages/website/sections/our-clients.vue";
import {ClientInterface} from "@interfaces/ClientInterface";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import OdooForYou from "@assets/images/odoo/odoo_for_you.jpg";

const props = defineProps<{
    clients: ClientInterface[];
}>();

const WhatIsOdooForYou: ListWithImageInterface = {
    title: 'pages.odoo.what_is_odoo_for_you.title',
    descriptions: [
        'pages.odoo.what_is_odoo_for_you.descriptions.0',
    ],
    listItems: [
        {
            title: 'pages.odoo.what_is_odoo_for_you.list_items.inventory_management.title',
            description: 'pages.odoo.what_is_odoo_for_you.list_items.inventory_management.description',
            image: OdooForYou
        },
        {
            title: 'pages.odoo.what_is_odoo_for_you.list_items.e_invoicing.title',
            description: 'pages.odoo.what_is_odoo_for_you.list_items.e_invoicing.description',
            image: OdooForYou
        },
        {
            title: 'pages.odoo.what_is_odoo_for_you.list_items.crm.title',
            description: 'pages.odoo.what_is_odoo_for_you.list_items.crm.description',
            image: OdooForYou
        },
        {
            title: 'pages.odoo.what_is_odoo_for_you.list_items.website.title',
            description: 'pages.odoo.what_is_odoo_for_you.list_items.website.description',
            image: OdooForYou
        }
    ]
}


</script>
<template>
    <website
        :margin-bottom="false"
        :meta-title="getTrans('pages.odoo.meta_title')"
    >
        <div id="page-website-expertise-odoo">
            <expertise-header
                title="pages.odoo.header.title"
                description="pages.odoo.header.description"
                :image="odooHeader"
            ></expertise-header>
            <list-with-image-component
                :list-with-image="WhatIsOdooForYou"
                class="container"
                :is-clickable="false"
            ></list-with-image-component>

            <our-clients
                :clients="props.clients"
            ></our-clients>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/expertise/odoo.css";
</style>
