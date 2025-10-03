<script setup lang="ts">

import {checkIfMenuItemIsActive, getFilteredChildren, getFilteredMenu} from "@composables/UseMenuComposable";
import {Link} from "@inertiajs/vue3";
import {getTrans} from "@composables/UseTranslationHelper";
import {ref} from "vue";
import {MenuInterface} from "@interfaces/MenuInterface";
import HomeController from "../../actions/App/Http/Controllers/HomeController";
import ContactController from "../../actions/App/Http/Controllers/ContactController";
import ProjectController from "../../actions/App/Http/Controllers/ProjectController";
import AboutUsController from "@actions/App/Http/Controllers/AboutUsController";
import WebDevelopmentExpertiseController
    from "@actions/App/Http/Controllers/Expertises/WebDevelopmentExpertiseController";
import AiIntegrationsExpertiseController
    from "@actions/App/Http/Controllers/Expertises/AiIntegrationsExpertiseController";
import AppsExpertiseController from "@actions/App/Http/Controllers/Expertises/AppsExpertiseController";
import OdooExpertiseController from "@actions/App/Http/Controllers/Expertises/OdooExpertiseController";
import IOTExpertiseController from "@actions/App/Http/Controllers/Expertises/IOTExpertiseController";
import RobawsExpertiseController from "@actions/App/Http/Controllers/Expertises/RobawsExpertiseController";

const props = defineProps<{
    type: 'header' | 'footer'
}>();

const primaryMenu = ref<MenuInterface[]>([
    {
        text: 'menu.primary.home',
        url: HomeController(),
        visible: true,
    },
    {
        text: 'menu.primary.our-expertises',
        visible: true,
        children: [
            {
                text: 'menu.primary.web_development',
                url: WebDevelopmentExpertiseController(),
                visible: true,
            },
            {
                text: 'menu.primary.ai_integrations',
                url: AiIntegrationsExpertiseController(),
                visible: true,
            },
            {
                text: 'menu.primary.apps',
                url: AppsExpertiseController(),
                visible: true,
            },
            {
                text: 'menu.primary.iot',
                url: IOTExpertiseController(),
                visible: true,
            },
            {
                text: 'menu.primary.odoo',
                url: OdooExpertiseController(),
                visible: true,
            },
            {
                text: 'menu.primary.robaws',
                url: RobawsExpertiseController(),
                visible: true,
            },
        ]
    },
    {
        text: 'menu.primary.projects',
        url: ProjectController(),
        visible: true,
    },
    {
        text: 'menu.primary.about_us',
        url: AboutUsController(),
        visible: true,
    },
    {
        text: 'menu.primary.contact',
        url: ContactController(),
        visible: true,
    },
]);
</script>
<template>
    <section
        :class="[
            'section-primary-menu',
            props.type === 'header' ? 'section-primary-menu-header' : 'section-primary-menu-footer'
            ]">
        <nav>
            <ul>
                <li v-for="item in getFilteredMenu(primaryMenu)" :key="item.text">
                    <Link
                        v-if="item.url"
                        prefetch
                        :class="[
                            'primary-menu-item',
                            checkIfMenuItemIsActive(item) ? 'active' : ''
                        ]"
                        :href="item.url.url"> {{ getTrans(item.text) }}
                    </Link>
                    <p
                        class="primary-menu-item"
                        v-else>
                        {{ getTrans(item.text) }}
                    </p>
                    <div
                        v-if="item.children"
                        class="children">
                        <ul v-if="item.children">
                            <li v-for="child in getFilteredChildren(item)" :key="child.text">
                                <Link
                                    v-if="child.url"
                                    prefetch
                                    :class="[
                                    'primary-menu-item-sub',
                                    checkIfMenuItemIsActive(child) ? 'active' : ''
                                    ]"
                                    :href="child.url.url"> {{ getTrans(child.text) }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </section>
</template>
<style scoped>
@import "@css/layouts/sections/primary-menu.css";
</style>
