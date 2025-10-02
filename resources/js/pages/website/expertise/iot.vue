<script setup lang="ts">
import Website from "@layouts/website.vue";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import Integrations from "@pages/website/expertise/sections/integrations.vue";
import {conceptToAppsBlock, integrationsList} from "@composables/expertises/useIOTComposable";
import iotHeader from "@assets/images/iot/header.png";

</script>
<template>
    <website
        :margin-bottom="false"
        :meta-title="getTrans('pages.iot.meta_title')"
    >
        <div id="page-website-expertise-iot" class="page-grid">
            <expertise-header
                title="pages.iot.header.title"
                description="pages.iot.header.description"
                :image="iotHeader"
            ></expertise-header>
            <list-with-image-component
                :list-with-image="conceptToAppsBlock"
                class="container"
                :is-clickable="false"
            ></list-with-image-component>
            <integrations
                :integrations-list="integrationsList"
                title="pages.iot.integrations.title"
                description="pages.iot.integrations.description"
                icon-size="small"
            ></integrations>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/expertise/iot.css";
</style>
