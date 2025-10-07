<script setup lang="ts">
import TitleComponent from "@components/title-component.vue";
import IntegrationComponent from "@components/integration-component.vue";
import {IntegrationInterface} from "@interfaces/IntegrationInterface";
import {TranslationKey} from "../../../../translations/lang-keys";
import {getTrans} from "@composables/UseTranslationHelper";

const props = defineProps<{
    integrationsList: IntegrationInterface[];
    title?: TranslationKey;
    description?: TranslationKey;
    iconSize?: 'small' | 'large';
    coloredBackground?: boolean;
}>();

</script>
<template>
    <section class="section-website-expertise-integrations"
    :class="[{'colored-bg': props.coloredBackground}]">
        <div class="container">
            <header
                v-if="props.title && props.description"
            >
                <title-component v-if="props.title">
                    <h2>{{ getTrans(props.title) }}</h2>
                </title-component>
                <p
                    v-if="props.description"
                >
                    {{ getTrans(props.description) }}
                </p>
            </header>
            <div class="integrations">
                <integration-component
                    v-for="integration in props.integrationsList"
                    :key="integration.title"
                    :integration="integration"
                    :icon-size="props.iconSize"
                ></integration-component>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/expertise/sections/integrations.css";
</style>
