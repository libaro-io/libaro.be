<script setup lang="ts">
import TextPage from "@pages/website/sections/text-page.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import Website from "@layouts/website.vue";
import ButtonComponent from "@components/button-component.vue";
import SupportTimecardController from "@actions/App/Http/Controllers/SupportTimecardController";
import robaws from "@assets/images/robaws.webp";
import robaws1 from "@assets/images/robaws-1.webp";
import robaws2 from "@assets/images/robaws-2.webp";
import robaws3 from "@assets/images/robaws-3.webp";
import robaws4 from "@assets/images/robaws-4.webp";
import {Link} from "@inertiajs/vue3";
</script>
<template>
    <website
        :margin-bottom="false"
        :header-options="{
            isHome: false,
            fullWidthDescription: true,
        }"
        :page-title="getTrans('timecard.integration.title')"
        meta-key="timecard_integration"
    >
        <div id="page-website-integration-timecard">
            <text-page>
                <section>
                    <img :src="robaws" alt="Robaws" class="w-[250px] mb-8"/>

                    <h2>{{ getTrans("timecard.integration.efficiency") }}</h2>
                    <p>
                        {{ getTrans("timecard.integration.intro.paragraph_1") }}
                    </p>
                </section>

                <section>
                    <h2>
                        {{
                            getTrans("timecard.integration.what_is_it.heading")
                        }}
                    </h2>
                    <p
                        v-html="
                            getTrans(
                                'timecard.integration.what_is_it.paragraph_1'
                            )
                        "
                    ></p>
                    <p
                        v-html="
                            getTrans(
                                'timecard.integration.what_is_it.paragraph_2'
                            )
                        "
                    ></p>
                    <p
                        v-html="
                            getTrans(
                                'timecard.integration.what_is_it.paragraph_3'
                            )
                        "
                    ></p>
                    <p
                        v-html="
                            getTrans(
                                'timecard.integration.what_is_it.paragraph_4'
                            )
                        "
                    ></p>
                    <p
                        v-html="
                            getTrans(
                                'timecard.integration.what_is_it.paragraph_5'
                            )
                        "
                    ></p>
                </section>

                <section>
                    <h2>
                        {{ getTrans("timecard.integration.benefits.heading") }}
                    </h2>
                    <p>
                        {{
                            getTrans("timecard.integration.benefits.paragraph")
                        }}
                    </p>
                    <ul>
                        <li
                            v-html="
                                getTrans('timecard.integration.benefits.list_1')
                            "
                        ></li>
                        <li
                            v-html="
                                getTrans('timecard.integration.benefits.list_2')
                            "
                        ></li>
                        <li
                            v-html="
                                getTrans('timecard.integration.benefits.list_3')
                            "
                        ></li>
                        <li
                            v-html="
                                getTrans('timecard.integration.benefits.list_4')
                            "
                        ></li>
                        <li
                            v-html="
                                getTrans('timecard.integration.benefits.list_5')
                            "
                        ></li>
                    </ul>
                </section>

                <section>
                    <h2>
                        {{
                            getTrans(
                                "timecard.integration.implementation.heading"
                            )
                        }}
                    </h2>
                    <p>
                        {{
                            getTrans(
                                "timecard.integration.implementation.paragraph_1"
                            )
                        }}
                    </p>
                    <ol>
                        <li
                            v-html="
                                getTrans(
                                    'timecard.integration.implementation.list_1'
                                )
                            "
                        ></li>
                        <li
                            v-html="
                                getTrans(
                                    'timecard.integration.implementation.list_2'
                                )
                            "
                        ></li>
                        <li
                            v-html="
                                getTrans(
                                    'timecard.integration.implementation.list_3'
                                )
                            "
                        ></li>
                    </ol>
                    <h3></h3>
                </section>

                <section>
                    <p>{{ getTrans("timecard.integration.questions") }}</p>
                    <Link :href="SupportTimecardController().url">
                        <button-component
                            :text="getTrans('timecard.integration.click_here')"
                        ></button-component>
                    </Link>
                </section>

                <section>
                    <div class="img-grid">
                        <div>
                            <img :src="robaws1" alt="Robaws"/>
                        </div>
                        <div>
                            <img :src="robaws2" alt="Robaws"/>
                        </div>
                        <div>
                            <img :src="robaws3" alt="Robaws"/>
                        </div>
                        <div class="col-span-full">
                            <img :src="robaws4" alt="Robaws"/>
                        </div>
                    </div>
                </section>
            </text-page>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/integration-timecard.css";
</style>
