<script setup lang="ts">

import {VacancyInterface} from "@interfaces/VacancyInterface";
import Website from "@layouts/website.vue";
import ContentBlock from "@pages/website/sections/content-block.vue";
import LargeImageSubtitleComponent from "@components/large-image-subtitle-component.vue";
import {computed} from "vue";
import {useS3Image} from "@composables/useS3Image";

const props = defineProps<{
    vacancy: VacancyInterface
}>()

const hero = computed(() => {
    return props.vacancy.image ? useS3Image(props.vacancy.image) : null
})
</script>
<template>
    <website
        :page-title="props.vacancy.title"
        :page-description="vacancy.description"
        :header-options="{
            whiteVariant: true,
            fullWidthDescription: true
        }"
        meta-key="vacancies"
        :meta-title-override="props.vacancy.title"
        :meta-description-override="props.vacancy.description"
        :marginBottom="false">
        <div id="page-website-vacancy">
            <content-block
                v-for="(block, index) in props.vacancy.blocks" :key="index"
                :alt="props.vacancy.title"
                :block="block"/>

            <large-image-subtitle-component
                class="mt-10"
                :image="hero"
                :contain-image="true"
                align="center"
            >
            </large-image-subtitle-component>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/vacancy.css";
</style>
