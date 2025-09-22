<script setup lang="ts">
import TextPage from "@pages/website/sections/text-page.vue";
import { getTrans } from "@composables/UseTranslationHelper";
import Website from "@layouts/website.vue";
</script>
<template>
    <website
        :page-title="getTrans('privacy.page_title')"
        :meta-title="getTrans('privacy.meta_title')"
        :marginBottom="false"
    >
        <div id="page-website-privacy-policy">
            <text-page>
                <section>
                    <h2 v-html="getTrans('privacy.intro.heading')"></h2>
                    <p
                        v-html="
                            getTrans('privacy.intro.paragraph_1', {
                                business_number: 'BE 0541.352.248',
                            })
                        "
                    ></p>
                    <p v-html="getTrans('privacy.intro.paragraph_2')"></p>
                </section>

                <section>
                    <h2
                        v-html="getTrans('privacy.data_processing.heading')"
                    ></h2>
                    <p
                        v-html="getTrans('privacy.data_processing.paragraph_1')"
                    ></p>
                    <p
                        v-html="getTrans('privacy.data_processing.paragraph_2')"
                    ></p>
                    <ul>
                        <li
                            v-html="
                                getTrans(
                                    'privacy.data_processing.list.create_account'
                                )
                            "
                        ></li>
                        <li
                            v-html="
                                getTrans(
                                    'privacy.data_processing.list.manage_store_info'
                                )
                            "
                        ></li>
                        <li
                            v-html="
                                getTrans(
                                    'privacy.data_processing.list.manage_store_reservations'
                                )
                            "
                        ></li>
                    </ul>
                </section>

                <section>
                    <h2 v-html="getTrans('privacy.why_process.heading')"></h2>
                    <p v-html="getTrans('privacy.why_process.paragraph_1')"></p>
                </section>

                <section>
                    <h2 v-html="getTrans('privacy.as_processor.heading')"></h2>
                    <p
                        v-html="getTrans('privacy.as_processor.paragraph_1')"
                    ></p>
                    <p
                        v-html="getTrans('privacy.as_processor.paragraph_2')"
                    ></p>
                    <p
                        v-html="getTrans('privacy.as_processor.paragraph_3')"
                    ></p>
                </section>

                <section>
                    <h2
                        v-html="getTrans('privacy.as_controller.heading_main')"
                    ></h2>

                    <article>
                        <h3
                            v-html="
                                getTrans(
                                    'privacy.as_controller.heading_billing'
                                )
                            "
                        ></h3>
                        <p
                            v-html="
                                getTrans(
                                    'privacy.as_controller.paragraph_billing_1'
                                )
                            "
                        ></p>
                        <p
                            v-html="
                                getTrans(
                                    'privacy.as_controller.paragraph_billing_2'
                                )
                            "
                        ></p>
                        <p
                            v-html="
                                getTrans(
                                    'privacy.as_controller.paragraph_billing_3'
                                )
                            "
                        ></p>
                    </article>

                    <article>
                        <h3
                            v-html="
                                getTrans(
                                    'privacy.as_controller.heading_third_parties'
                                )
                            "
                        ></h3>
                        <p
                            v-html="
                                getTrans(
                                    'privacy.as_controller.paragraph_third_parties'
                                )
                            "
                        ></p>
                    </article>

                    <article>
                        <h3
                            v-html="
                                getTrans(
                                    'privacy.as_controller.heading_analysis'
                                )
                            "
                        ></h3>
                        <p
                            v-html="
                                getTrans(
                                    'privacy.as_controller.paragraph_analysis_1'
                                )
                            "
                        ></p>
                        <p
                            v-html="
                                getTrans(
                                    'privacy.as_controller.paragraph_analysis_2'
                                )
                            "
                        ></p>
                    </article>

                    <article>
                        <h3
                            v-html="
                                getTrans(
                                    'privacy.as_controller.heading_marketing'
                                )
                            "
                        ></h3>
                        <p
                            v-html="
                                getTrans(
                                    'privacy.as_controller.paragraph_marketing_1'
                                )
                            "
                        ></p>
                        <p
                            v-html="
                                getTrans(
                                    'privacy.as_controller.paragraph_marketing_2'
                                )
                            "
                        ></p>
                    </article>
                </section>

                <section>
                    <h2 v-html="getTrans('privacy.data_sharing.heading')"></h2>
                    <p
                        v-html="getTrans('privacy.data_sharing.paragraph_1')"
                    ></p>
                    <p
                        v-html="getTrans('privacy.data_sharing.paragraph_2')"
                    ></p>
                    <p
                        v-html="getTrans('privacy.data_sharing.paragraph_3')"
                    ></p>
                </section>

                <section>
                    <h2 v-html="getTrans('privacy.data_security.heading')"></h2>
                    <p
                        v-html="getTrans('privacy.data_security.paragraph_1')"
                    ></p>
                </section>

                <section>
                    <h2
                        v-html="getTrans('privacy.data_retention.heading')"
                    ></h2>
                    <p
                        v-html="getTrans('privacy.data_retention.paragraph_1')"
                    ></p>
                    <p
                        v-html="getTrans('privacy.data_retention.paragraph_2')"
                    ></p>
                </section>

                <section>
                    <h2 v-html="getTrans('privacy.user_rights.heading')"></h2>
                    <p v-html="getTrans('privacy.user_rights.intro')"></p>
                    <ul>
                        <li
                            v-html="getTrans('privacy.user_rights.bullet_1')"
                        ></li>
                        <li
                            v-html="getTrans('privacy.user_rights.bullet_2')"
                        ></li>
                        <li
                            v-html="getTrans('privacy.user_rights.bullet_3')"
                        ></li>
                        <li
                            v-html="getTrans('privacy.user_rights.bullet_4')"
                        ></li>
                    </ul>
                    <p v-html="getTrans('privacy.user_rights.outro')"></p>
                </section>

                <section>
                    <h2 v-html="getTrans('privacy.changes.heading')"></h2>
                    <p v-html="getTrans('privacy.changes.paragraph_1')"></p>
                </section>

                <section>
                    <h2 v-html="getTrans('privacy.questions.heading')"></h2>
                    <p v-html="getTrans('privacy.questions.paragraph_1')"></p>
                </section>
            </text-page>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/privacy-policy.css";
</style>
