<script setup lang="ts">
import NavigationFooter from "@layouts/sections/navigation-footer.vue";
import Footer from "@layouts/sections/footer.vue";
import {setUrlDefaults} from "../wayfinder";
import {Head} from "@inertiajs/vue3";
import {computed} from "vue";
import Header from "@layouts/sections/header.vue";

setUrlDefaults({
    locale: 'nl',
});

const props = withDefaults(defineProps<{
    pageTitle?: string;
    pageSubTitle?: string;
    pageDescription?: string;
    metaTitle?: string | null;
    description?: string;
    marginBottom?: boolean;
}>(), {
    metaTitle: null,
    marginBottom: true,
});

const getTitle = computed(() => {
    return props.metaTitle ? props.metaTitle + ' | Libaro' : 'Libaro';
})

</script>
<template>
    <Head
        :title="getTitle"
        :description="props.description ?? ''"
    ></Head>
    <div id="layout-website">
        <Header
            :margin-bottom="props.marginBottom"
            :page-title="props.pageTitle"
            :page-sub-title="props.pageSubTitle"
            :page-description="props.pageDescription"
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
