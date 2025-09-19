<script setup lang="ts">
import NavigationFooter from "@layouts/sections/navigation-footer.vue";
import Footer from "@layouts/sections/footer.vue";
import {setUrlDefaults} from "../wayfinder";
import {Head} from "@inertiajs/vue3";
import {computed} from "vue";
setUrlDefaults({
    locale: 'nl',
});

const props = withDefaults(defineProps<{
    title?: string | null;
    description?: string;
}>(), {
    title: null,

});

const makeTitle = computed(() => {
  return props.title ? props.title + ' | Libaro' : 'Libaro';
})

</script>
<template>
    <Head
        :title="makeTitle"
        :description="props.description ?? ''"
    ></Head>
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
