<script setup lang="ts">
import IconComponent from "@components/icon-component.vue";
import {IntegrationInterface} from "@interfaces/IntegrationInterface";
import SubTitleComponent from "@components/sub-title-component.vue";
import BadgeComponent from "@components/badge-component.vue";
import {getTrans} from "@composables/UseTranslationHelper";

const props = defineProps<{
    integration: IntegrationInterface;
}>();

</script>
<template>
    <section class="component-integration-component">
        <div class="icon">
            <icon-component
                :image="props.integration.icon"
                :name="props.integration.title"
            ></icon-component>
        </div>
        <div class="title">
            <sub-title-component
                :has-margin="false"
            >
                <h3>{{ getTrans(props.integration.title) }}</h3>
            </sub-title-component>
        </div>
        <p>
            {{getTrans( props.integration.description) }}
        </p>
        <ul>
            <li
                v-for="badge in props.integration.badges"
                :key="badge"
            >
                <badge-component>
                    {{getTrans(badge)}}
                </badge-component>
            </li>
        </ul>

    </section>
</template>
<style scoped>
@import "@css/components/integration-component.css";
</style>
