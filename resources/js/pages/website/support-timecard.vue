<script setup lang="ts">
import {getTrans} from "@composables/UseTranslationHelper";
import Website from "@layouts/website.vue";
import TextPage from "@pages/website/sections/text-page.vue";
import robaws from "@assets/images/robaws.webp";
import robawsIos from "@assets/images/robaws-ios.webp";
import robawsAndroid from "@assets/images/robaws-android.webp";
import Accordion from "@components/accordion.vue";
import {computed} from "vue";

const accordionItems = computed(() => [
        {
            title: getTrans('timecard.support.faq.questions.how_to_sync_robaws.question'),
            description: getTrans('timecard.support.faq.questions.how_to_sync_robaws.answer'),
        },
        {
            title: getTrans('timecard.support.faq.questions.edit_after_sync.question'),
            description: getTrans('timecard.support.faq.questions.edit_after_sync.answer'),
        },
        {
            title: getTrans('timecard.support.faq.questions.articles_not_visible.question'),
            description: getTrans('timecard.support.faq.questions.articles_not_visible.answer')
        },
        {
            title: getTrans('timecard.support.faq.questions.user_roles.question'),
            description: getTrans('timecard.support.faq.questions.user_roles.answer')
        },
        {
            title: getTrans('timecard.support.faq.questions.no_internet.question'),
            description: getTrans('timecard.support.faq.questions.no_internet.answer')
        },
        {
            title: getTrans('timecard.support.faq.questions.vehicles_and_equipment.question'),
            description: getTrans('timecard.support.faq.questions.vehicles_and_equipment.answer')
        },
        {
            title: getTrans('timecard.support.faq.questions.multiple_projects.question'),
            description: getTrans('timecard.support.faq.questions.multiple_projects.answer')
        },
        {
            title: getTrans('timecard.support.faq.questions.correct_sync.question'),
            description: getTrans('timecard.support.faq.questions.correct_sync.answer')
        },
        {
            title: getTrans('timecard.support.faq.questions.error_messages.question'),
            description: getTrans('timecard.support.faq.questions.error_messages.answer')
        },
        {
            title: getTrans('timecard.support.faq.questions.pricing_structure.question'),
            description: getTrans('timecard.support.faq.questions.pricing_structure.answer')
        }
    ]
);
</script>
<template>
    <website
        :margin-bottom="false"
        :header-options="{
            isHome: false,
            fullWidthDescription: true,
        }"
        :page-title="getTrans('timecard.support.title')"
        meta-key="timecard_support"
    >
        <div id="page-website-support-timecard">
            <text-page>
                <section>
                    <img :src="robaws" alt="Robaws" class="w-[250px] mb-8"/>
                    <h2>{{ getTrans('timecard.support.documentation.heading') }}</h2>
                    <a href="https://docs.google.com/document/u/0/d/1s5Svw9ffZtxFpLzbvqRdkBwkB3X04SZQ7JVPh92rJ1s/edit" target="_blank">{{ getTrans('timecard.support.documentation.manual') }} <i class="fa-solid fa-download"></i></a>
                </section>

                <section>
                    <h2>{{ getTrans('timecard.support.installation_instructions.heading') }}</h2>
                    <p>{{ getTrans('timecard.support.installation_instructions.description') }}</p>
                </section>

                <section>
                    <h2>{{ getTrans('timecard.support.faq.heading') }}</h2>
                    <accordion :items="accordionItems"></accordion>
                </section>

                <section>
                    <div class="grid lg:grid-cols-5 items-center">
                        <div class="lg:col-span-4">
                            <h2>{{ getTrans('timecard.support.installation_instructions.ios.heading') }}</h2>
                            <ol>
                                <li v-html="getTrans('timecard.support.installation_instructions.ios.step_1')"></li>
                                <li v-html="getTrans('timecard.support.installation_instructions.ios.step_2')"></li>
                                <li v-html="getTrans('timecard.support.installation_instructions.ios.step_3')"></li>
                                <li v-html="getTrans('timecard.support.installation_instructions.ios.step_4')"></li>
                                <li v-html="getTrans('timecard.support.installation_instructions.ios.step_5')"></li>
                                <li v-html="getTrans('timecard.support.installation_instructions.ios.step_6')"></li>
                            </ol>
                        </div>
                        <div>
                            <img :src="robawsIos" alt="Robaws - iOS" class="img-border max-w-[250px]"/>
                        </div>
                    </div>
                </section>

                <!-- Android Instructions Section -->
                <section>
                    <div class="grid lg:grid-cols-5 items-center">
                        <div class="lg:col-span-4">
                            <h2>{{ getTrans('timecard.support.installation_instructions.android.title') }}</h2>
                            <ol>
                                <li v-html="getTrans('timecard.support.installation_instructions.android.step_1')"></li>
                                <li v-html="getTrans('timecard.support.installation_instructions.android.step_2')"></li>
                                <li v-html="getTrans('timecard.support.installation_instructions.android.step_3')"></li>
                                <li v-html="getTrans('timecard.support.installation_instructions.android.step_4')"></li>
                                <li v-html="getTrans('timecard.support.installation_instructions.android.step_5')"></li>
                                <li v-html="getTrans('timecard.support.installation_instructions.android.step_6')"></li>
                            </ol>
                        </div>

                        <div>
                            <img :src="robawsAndroid" alt="Robaws - Android" class="img-border max-w-[250px]"/>
                        </div>
                    </div>
                </section>

                <!-- Further Help Section -->
                <section>
                    <h2>{{ getTrans('timecard.support.installation_instructions.further_help.support_inquiry') }}</h2>
                    <p v-html="getTrans('timecard.support.installation_instructions.further_help.team_ready')"></p>
                    <p>
                        Email: <a :href="`mailto:${getTrans('timecard.support.installation_instructions.further_help.email')}`">{{ getTrans('timecard.support.installation_instructions.further_help.email') }}</a>
                    </p>
                    <p v-html="getTrans('timecard.support.installation_instructions.further_help.availability')"></p>
                </section>
            </text-page>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/support-timecard.css";
</style>
