<script setup lang="ts">
import TextPage from "@pages/website/sections/text-page.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import Website from "@layouts/website.vue";
</script>
<template>
    <website
        :page-title="getTrans('cookie.page_title')"
        meta-key="cookies"
        :marginBottom="false"
    >
        <div id="page-website-cookie-policy">
            <text-page>
                <section>
                    <h2>{{ getTrans("cookie.intro.heading") }}</h2>
                    <p v-html="getTrans('cookie.intro.paragraph')"></p>
                </section>
                <section>
                    <h2>{{ getTrans("cookie.google_analytics.heading") }}</h2>
                    <p v-html="getTrans('cookie.google_analytics.paragraph')"></p>
                </section>

                <section>
                    <h2>{{ getTrans("cookie.what_are_cookies.heading") }}</h2>
                    <p>{{ getTrans("cookie.what_are_cookies.paragraph") }}</p>
                </section>
            </text-page>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/sections/text-page.css";
</style>
