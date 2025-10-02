<script setup lang="ts">
import TextPage from "@pages/website/sections/text-page.vue";
import { getTrans } from "@composables/UseTranslationHelper";
import Website from "@layouts/website.vue";
</script>
<template>
    <website
        :page-title="getTrans('terms.page_title')"
        meta-key="terms"
        :marginBottom="false"
    >
        <div id="page-website-terms">
            <text-page>
                <section>
                    <h2 v-text="getTrans('terms.intro.heading')"></h2>
                    <p v-text="getTrans('terms.intro.paragraph_1')"></p>
                    <p v-text="getTrans('terms.intro.paragraph_2')"></p>
                    <p v-text="getTrans('terms.intro.paragraph_3')"></p>
                    <p v-text="getTrans('terms.intro.paragraph_4')"></p>
                </section>

                <section>
                    <h2 v-text="getTrans('terms.purpose.heading')"></h2>
                    <p v-text="getTrans('terms.purpose.paragraph')"></p>
                </section>

                <section>
                    <h2 v-text="getTrans('terms.use_of_website.heading')"></h2>
                    <p
                        v-text="getTrans('terms.use_of_website.paragraph_1')"
                    ></p>
                    <p
                        v-text="getTrans('terms.use_of_website.paragraph_2')"
                    ></p>
                    <p
                        v-text="getTrans('terms.use_of_website.paragraph_3')"
                    ></p>
                    <ul>
                        <li
                            v-text="getTrans('terms.use_of_website.list_1')"
                        ></li>
                        <li
                            v-text="getTrans('terms.use_of_website.list_2')"
                        ></li>
                        <li
                            v-text="getTrans('terms.use_of_website.list_3')"
                        ></li>
                        <li
                            v-text="getTrans('terms.use_of_website.list_4')"
                        ></li>
                        <li
                            v-text="getTrans('terms.use_of_website.list_5')"
                        ></li>
                        <li
                            v-text="getTrans('terms.use_of_website.list_6')"
                        ></li>
                    </ul>
                </section>

                <section>
                    <h2 v-text="getTrans('terms.disclaimer.heading')"></h2>
                    <p v-text="getTrans('terms.disclaimer.paragraph_1')"></p>
                    <p v-text="getTrans('terms.disclaimer.paragraph_2')"></p>
                    <p v-text="getTrans('terms.disclaimer.paragraph_3')"></p>
                    <p v-text="getTrans('terms.disclaimer.paragraph_4')"></p>
                </section>

                <section>
                    <h2 v-text="getTrans('terms.accounts.heading')"></h2>
                    <p v-text="getTrans('terms.accounts.paragraph_1')"></p>
                    <p v-text="getTrans('terms.accounts.paragraph_2')"></p>
                    <p v-text="getTrans('terms.accounts.paragraph_3')"></p>
                    <p v-text="getTrans('terms.accounts.paragraph_4')"></p>
                </section>

                <section>
                    <h2
                        v-text="getTrans('terms.intellectual_property.heading')"
                    ></h2>
                    <p
                        v-text="
                            getTrans('terms.intellectual_property.paragraph')
                        "
                    ></p>
                </section>

                <section>
                    <h2 v-text="getTrans('terms.communication.heading')"></h2>
                    <p v-text="getTrans('terms.communication.paragraph')"></p>
                </section>

                <section>
                    <h2 v-text="getTrans('terms.amendments.heading')"></h2>
                    <p v-text="getTrans('terms.amendments.paragraph_1')"></p>
                    <p v-text="getTrans('terms.amendments.paragraph_2')"></p>
                </section>

                <section>
                    <h2 v-text="getTrans('terms.jurisdiction.heading')"></h2>
                    <p v-text="getTrans('terms.jurisdiction.paragraph_1')"></p>
                    <p v-text="getTrans('terms.jurisdiction.paragraph_2')"></p>
                </section>
            </text-page>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/sections/text-page.css";
</style>
