<script setup lang="ts">
import NavigationFooter from "@layouts/sections/navigation-footer.vue";
import Footer from "@layouts/sections/footer.vue";
import {defineAsyncComponent} from "vue";

</script>
<template>
    <div id="layout-website">
        website layout
        <div class="content">
            <slot></slot>
        </div>
        <navigation-footer></navigation-footer>
        <Footer></Footer>
    </div>
</template>
<style scoped>
@import "@css/layouts/website.css";
</style>
