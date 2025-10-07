<script setup lang="ts">

import {TranslationKey} from "../../../translations/lang-keys";
import {getTrans} from "@composables/UseTranslationHelper";
import {LinkBuilderInterface} from "@interfaces/LinkBuilderInterface";
import WebDevelopmentExpertiseController
    from "@actions/App/Http/Controllers/Expertises/WebDevelopmentExpertiseController";
import AiIntegrationsExpertiseController
    from "@actions/App/Http/Controllers/Expertises/AiIntegrationsExpertiseController";
import OdooExpertiseController from "@actions/App/Http/Controllers/Expertises/OdooExpertiseController";
import AppsExpertiseController from "@actions/App/Http/Controllers/Expertises/AppsExpertiseController";
import RobawsExpertiseController from "@actions/App/Http/Controllers/Expertises/RobawsExpertiseController";
import IOTExpertiseController from "@actions/App/Http/Controllers/Expertises/IOTExpertiseController";
import {Link} from "@inertiajs/vue3";

interface ourExpertise {
    link: LinkBuilderInterface;
    title: TranslationKey;
    description: TranslationKey;
    icon: string;
}

const ourExpertises: ourExpertise[] = [
    {
        link: WebDevelopmentExpertiseController(),
        title: 'menu.primary.web_development',
        description: 'pages.webdevelopment.header.description',
        icon: 'fa-solid fa-code'
    },
    {
        link: AiIntegrationsExpertiseController(),
        title: 'menu.primary.ai_integrations',
        description: 'pages.ai.header.description.0',
        icon: 'fa-solid fa-wand-magic-sparkles'
    },
    {
        link: AppsExpertiseController(),
        title: 'menu.primary.apps',
        description: 'pages.apps.header.description',
        icon: 'fa-solid fa-mobile-screen'
    },
    {
        link: IOTExpertiseController(),
        title: 'menu.primary.iot',
        description: 'pages.iot.header.description',
        icon: 'fa-solid fa-microchip'
    },
    {
        link: OdooExpertiseController(),
        title: 'menu.primary.odoo',
        description: 'pages.odoo.header.description',
        icon: 'fa-kit fa-odoo'
    },
    {
        link: RobawsExpertiseController(),
        title: 'menu.primary.robaws',
        description: 'pages.robaws.header.description.0',
        icon: 'fa-kit fa-robaws'
    }
]


</script>
<template>
    <section class="section-website-our-expertises">
       <div class="container">
           <div class="inner-container">
               <Link
                   prefetch
                   :href="item.link"
                   v-for="item in ourExpertises"
                   :key="item.title"
                   class="expertise-item"
               >
                   <div class="icon">
                       <i :class="item.icon"></i>
                   </div>
                   <div class="texts">
                       <h3 class="title">{{ getTrans(item.title) }}</h3>
                       <p class="description">{{ getTrans(item.description) }}</p>
                   </div>
               </Link>
           </div>
       </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/our-expertises.css";
</style>
