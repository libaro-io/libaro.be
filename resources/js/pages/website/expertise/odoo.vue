<script setup lang="ts">
import Website from "@layouts/website.vue";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import odooHeader from "@assets/images/odoo/header.gif";
import ContactForm from "@pages/website/sections/contact-form.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import ListWithImageComponent from "@components/list-with-image-component.vue";

import LargeImageWithTextComponent from "@components/large-image-with-text-component.vue";
import ChooseOdoo from "@assets/images/odoo/choose_odoo.webp";
import Integrations from "@pages/website/expertise/sections/integrations.vue";
import {IntegrationInterface} from "@interfaces/IntegrationInterface";
import {getIntegrations, getWhatIsOdooYou} from "@composables/expertises/UseOdooComposable";


const WhatIsOdooForYou: ListWithImageInterface = getWhatIsOdooYou();

const integrationsList: IntegrationInterface[] = getIntegrations();

</script>
<template>
    <website
        :margin-bottom="false"
        meta-key="odoo_expertise"
    >
        <div id="page-website-expertise-odoo" class="page-grid">
            <expertise-header
                title="pages.odoo.header.title"
                description="pages.odoo.header.description"
                :image="odooHeader"
            ></expertise-header>

            <list-with-image-component
                :list-with-image="WhatIsOdooForYou"
                class="container"
                :is-clickable="false"
                :enable3d-effect="true"
            ></list-with-image-component>

            <integrations
                :integrations-list="integrationsList"
                title="pages.odoo.integrations.title"
                description="pages.odoo.integrations.description"
                :colored-background="true"
            ></integrations>

            <large-image-with-text-component
                class="container"
                :image="ChooseOdoo"
                title="pages.odoo.why_choose_odoo.title"
                text="pages.odoo.why_choose_odoo.text"
            ></large-image-with-text-component>

            <contact-form
                :title="getTrans('pages.odoo.contact_form.title')"
                class="container">
            </contact-form>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/expertise/odoo.css";
</style>
