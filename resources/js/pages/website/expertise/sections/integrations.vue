<script setup lang="ts">
import TitleComponent from "@components/title-component.vue";
import IntegrationComponent from "@components/integration-component.vue";
import {IntegrationInterface} from "@interfaces/IntegrationInterface";
import {TranslationKey} from "../../../../translations/lang-keys";
import {getTrans} from "@composables/UseTranslationHelper";

const props = defineProps<{
    integrationsList: IntegrationInterface[];
    title: TranslationKey;
    description: TranslationKey;
    iconSize?: 'small' | 'large';
}>();

</script>
<template>
    <section class="section-website-expertise-integrations container">
       <header>
           <title-component>
               <h2>{{getTrans(props.title)}}</h2>
           </title-component>
            <p>{{getTrans(props.description)}}</p>
       </header>
        <div class="integrations">
            <integration-component
                v-for="integration in props.integrationsList"
                :key="integration.title"
                :integration="integration"
                :icon-size="props.iconSize"
            ></integration-component>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/expertise/sections/integrations.css";
</style>
