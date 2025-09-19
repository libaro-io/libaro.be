<script setup lang="ts">
import Website from "@layouts/website.vue";
import {getTrans} from "@composables/UseTranslationHelper";
</script>
<template>
    <Website
        :page-title="getTrans('contact.page_title')"
        :page-sub-title="getTrans('contact.page_sub_title')"
        :meta-title="getTrans('contact.meta_title')">
        <div id="page-website-contact">
            page contact
        </div>
    </Website>
</template>
<style scoped>
@import "@css/pages/website/contact.css";
</style>
