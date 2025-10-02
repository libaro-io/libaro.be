<script setup lang="ts">
import NavigationFooter from "@layouts/sections/navigation-footer.vue";
import Footer from "@layouts/sections/footer.vue";
import { setUrlDefaults } from "../wayfinder";
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import Header, { HeaderOptions } from "@layouts/sections/header.vue";
import PageInterface from "@interfaces/PageInterface";
import { getTrans } from "@composables/UseTranslationHelper";

const page = usePage<PageInterface>();

setUrlDefaults({
    locale: page.props.pageProps.locale,
});

const props = withDefaults(
    defineProps<{
        pageTitle?: string;
        pageSubTitle?: string;
        pageDescription?: string | null;
        headerOptions?: HeaderOptions;
        metaTitle?: string | null;
        description?: string;
        marginBottom?: boolean;
    }>(),
    {
        metaTitle: null,
        marginBottom: true,
    }
);

const getTitle = computed(() => {
    return "Libaro | " + (props.pageTitle ?? getTrans("seo.general.tagline"));
});

const getDescription = computed(() => {
    return props.description ?? getTrans("seo.general.description");
});

const getCanonical = computed(() => {
    return window.location.origin + window.location.pathname;
});
</script>
<template>
    <Head :title="getTitle">
        <meta name="description" :content="getDescription" />
        <meta name="canonical" :content="getCanonical" />

        <meta property="og:title" :content="getTitle" />
        <meta property="og:description" :content="getDescription" />

        <meta property="twitter:title" :content="getTitle" />
        <meta property="twitter:description" :content="getDescription" />
    </Head>
    <div id="layout-website">
        <Header
            :margin-bottom="props.marginBottom"
            :page-title="props.pageTitle"
            :page-sub-title="props.pageSubTitle"
            :page-description="props.pageDescription"
            :options="props.headerOptions ?? {}"
        ></Header>
        <main class="content">

            <slot></slot>
        </main>
        <navigation-footer></navigation-footer>
        <Footer></Footer>
    </div>
</template>
<style scoped>
@import "@css/layouts/website.css";
</style>
