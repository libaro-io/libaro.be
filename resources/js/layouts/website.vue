<script setup lang="ts">
import NavigationFooter from "@layouts/sections/navigation-footer.vue";
import Footer from "@layouts/sections/footer.vue";
import { setUrlDefaults } from "../wayfinder";
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import Header, { HeaderOptions } from "@layouts/sections/header.vue";
import PageInterface from "@interfaces/PageInterface";
import { getTrans } from "@composables/UseTranslationHelper";
import { SeoMetaKey } from "@composables/UseMetaHelper";

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
        metaKey: SeoMetaKey;
        metaTitleOverride?: string | null;
        metaDescriptionOverride?: string | null;
        description?: string;
        marginBottom?: boolean;
    }>(),
    {
        marginBottom: true,
    }
);

const metaTitleByMetaKey = computed(() => {
    return getTrans(`seo.pages.${props.metaKey}.title`);
});

const metaDescriptionByMetaKey = computed(() => {
    return getTrans(`seo.pages.${props.metaKey}.description`);
});

const getTitle = computed(() => {
    return (
        "Libaro | " +
        (props.metaTitleOverride ??
            metaTitleByMetaKey.value ??
            getTrans("seo.general.tagline"))
    );
});

const getDescription = computed(() => {
    const description =
        props.metaDescriptionOverride ??
        metaDescriptionByMetaKey.value ??
        getTrans("seo.general.description");

    if (description.length > 170) {
        return description.substring(0, 167) + "...";
    }

    return description;
});

const getCanonical = computed(() => {
    return page.props.pageProps.url.origin + page.props.pageProps.url.pathname;
});
</script>
<template>
    <Head :title="getTitle">
        <meta name="description" :content="getDescription" />
        <link rel="canonical" :href="getCanonical" />

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
