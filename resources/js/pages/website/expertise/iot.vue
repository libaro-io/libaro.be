<script setup lang="ts">
import Website from "@layouts/website.vue";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import Integrations from "@pages/website/expertise/sections/integrations.vue";
import {conceptToAppsBlock, integrationsList, whyIOTList} from "@composables/expertises/useIOTComposable";
import iotHeader from "@assets/images/iot/header.png";
import LargeImageWithTextComponent from "@components/large-image-with-text-component.vue";
import ChooseIOT from "@assets/images/iot/choose_iot.png";
import OurClients from "@pages/website/sections/our-clients.vue";
import {ClientInterface} from "@interfaces/ClientInterface";


const props = defineProps<{
    clients?: ClientInterface[];
}>();

</script>
<template>
    <website
        :margin-bottom="false"
        meta-key="iot_expertise"
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
            <large-image-with-text-component
                class="container"
                :image="ChooseIOT"
                title="pages.iot.why_choose_iot.title"
                text="pages.iot.why_choose_iot.text"
            ></large-image-with-text-component>
            <integrations
                :integrations-list="whyIOTList"
                icon-size="small"
            ></integrations>
            <our-clients
                :clients="props.clients"
            ></our-clients>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/expertise/iot.css";
</style>
