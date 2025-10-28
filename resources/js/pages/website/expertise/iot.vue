<script setup lang="ts">
import Website from "@layouts/website.vue";
import ExpertiseHeader from "@pages/website/expertise/sections/expertise-header.vue";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import Integrations from "@pages/website/expertise/sections/integrations.vue";
import {conceptToAppsBlock, integrationsList, whyIOTList} from "@composables/expertises/useIOTComposable";
import iotHeader from "@assets/images/iot/header.png";
import LargeImageWithTextComponent from "@components/large-image-with-text-component.vue";
import ChooseIOT from "@assets/images/iot/choose_iot.png";
import {getTrans} from "@composables/UseTranslationHelper";
import TheseSectors from "@pages/website/expertise/sections/these-sectors.vue";
import {ProjectInterface} from "@interfaces/ProjectInterface";
import CtaContact from "@pages/website/sections/cta-contact.vue";

const props = defineProps<{
    projects?: ProjectInterface[];
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

            <integrations
                :integrations-list="integrationsList"
                title="pages.iot.integrations.title"
                description="pages.iot.integrations.description"
                icon-size="small"
            ></integrations>``

            <list-with-image-component
                :list-with-image="conceptToAppsBlock"
                :is-clickable="false"
                :colored-background="true"
                :enable3d-effect="true"
            ></list-with-image-component>

            <large-image-with-text-component
                class="container"
                :image="ChooseIOT"
                title="pages.iot.why_choose_iot.title"
                text="pages.iot.why_choose_iot.text"
            ></large-image-with-text-component>

            <integrations
                :integrations-list="whyIOTList"
                icon-size="small"
                :colored-background="true"
            ></integrations>

            <these-sectors
            :title="getTrans('pages.iot.these_sectors.title')"
            :projects="props.projects"
            ></these-sectors>

            <cta-contact
                title="pages.iot.contact_form.title"
            ></cta-contact>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/expertise/iot.css";
</style>

