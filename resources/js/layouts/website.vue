<script setup lang="ts">
import NavigationFooter from "@layouts/sections/navigation-footer.vue";
import Footer from "@layouts/sections/footer.vue";
import {setUrlDefaults} from "../wayfinder";
import {Head} from "@inertiajs/vue3";
setUrlDefaults({
    locale: 'nl',
});

const props = defineProps<{
    title?: string;
}>();

</script>
<template>
    <Head :title="props.title ?? '' + ' | Libaro'"></Head>
    <div id="layout-website">
        website layout
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
