<script setup lang="ts">
import Website from "@layouts/website.vue";
import AssetsSection from "@pages/website/sections/assets.vue";
import {getTrans} from "@composables/UseTranslationHelper";
</script>
<template>
    <website
        :header-options="{
            fullWidthDescription: true,
        }"
        :page-title="getTrans('pages.assets.title')"
        :page-sub-title="getTrans('pages.assets.subtitle')"
        :page-description="getTrans('pages.assets.description')"
        meta-key="assets"
    >
        <div id="page-website-assets">
            <assets-section></assets-section>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/assets.css";
</style>
