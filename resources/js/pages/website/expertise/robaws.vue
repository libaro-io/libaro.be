<script setup lang="ts">
import Website from "@layouts/website.vue";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import robawsHeader from "@assets/images/robaws/header.gif";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import BryonImage from "@assets/images/robaws/bryon.jpg";
import DetailProjectController from "@actions/App/Http/Controllers/DetailProjectController";
import LargeImageWithTextComponent from "@components/large-image-with-text-component.vue";
import LaptopRobawsImage from "@assets/images/robaws/laptop.png";
import {onMounted} from "vue";
import {LinkBuilderInterface} from "@interfaces/LinkBuilderInterface";
import ContactForm from "@pages/website/sections/contact-form.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import TitleComponent from "@components/title-component.vue";

const getUrl = (slug: 'onderaannemers-app' | 'bryon-dagrapporten-app-teamleaders' | 'verhelst-group-tijdsregistratie-app'): LinkBuilderInterface => {
    return DetailProjectController({project: slug});
}

let howWeMakerobawsBetter: ListWithImageInterface | null;

onMounted(() => {
    howWeMakerobawsBetter =
        {
            title: 'pages.robaws.how_we_make_robaws_better.title',
            descriptions: [
                'pages.robaws.how_we_make_robaws_better.description'
            ],
            listItems: [
                {
                    title: 'pages.robaws.how_we_make_robaws_better.list_items.mobile_app.title',
                    description: 'pages.robaws.how_we_make_robaws_better.list_items.mobile_app.description',
                    image: BryonImage,
                    link: {
                        title: 'pages.robaws.how_we_make_robaws_better.list_items.mobile_app.link',
                        url: getUrl('onderaannemers-app'),
                    }
                },
                {
                    title: 'pages.robaws.how_we_make_robaws_better.list_items.daily_reports.title',
                    description: 'pages.robaws.how_we_make_robaws_better.list_items.daily_reports.description',
                    image: BryonImage,
                    link: {
                        title: 'pages.robaws.how_we_make_robaws_better.list_items.daily_reports.link',
                        url: getUrl('bryon-dagrapporten-app-teamleaders'),
                    }
                },
                {
                    title: 'pages.robaws.how_we_make_robaws_better.list_items.time_registration.title',
                    description: 'pages.robaws.how_we_make_robaws_better.list_items.time_registration.description',
                    badges: [
                        'pages.robaws.how_we_make_robaws_better.list_items.time_registration.badges.0',
                        'pages.robaws.how_we_make_robaws_better.list_items.time_registration.badges.1',
                        'pages.robaws.how_we_make_robaws_better.list_items.time_registration.badges.2'
                    ],
                    image: BryonImage,
                    link: {
                        title: 'pages.robaws.how_we_make_robaws_better.list_items.time_registration.link',
                        url: getUrl('verhelst-group-tijdsregistratie-app'),
                    }
                }
            ]
        }
})

</script>
<template>
    <website
        :margin-bottom="false"
        meta-key="robaws"
    >
        <div id="page-website-expertise-robaws" class="page-grid">
            <expertise-header
                title="pages.robaws.header.title"
                :description="[
                    'pages.robaws.header.description.0',
                    'pages.robaws.header.description.1'
                ]"
                :image="robawsHeader"
            ></expertise-header>

            <list-with-image-component
                v-if="howWeMakerobawsBetter"
                :list-with-image="howWeMakerobawsBetter"
                class="container"
                :is-clickable="false"
                :enable3d-effect="true"
            ></list-with-image-component>

            <large-image-with-text-component
                class="container"
                :image="LaptopRobawsImage"
                title="pages.robaws.api_integration.title"
                text="pages.robaws.api_integration.text"
            ></large-image-with-text-component>
            <div class="contact-block container">
                <title-component>
                    <h2> {{ getTrans('pages.robaws.contact_form.title') }}</h2>
                </title-component>
                <contact-form>
                </contact-form>
            </div>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/expertise/robaws.css";
</style>
