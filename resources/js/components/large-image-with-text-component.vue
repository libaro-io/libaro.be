<script setup lang="ts">

import {TranslationKey} from "../translations/lang-keys";
import LargeImageComponent from "@components/large-image-component.vue";
import titleComponent from "@components/title-component.vue";

const props = defineProps<{
    image: string;
    title: TranslationKey,
    text: TranslationKey,
}>()

</script>
<template>
    <section class="component-large-image-with-text-component">
        <div class="text-container">
            <title-component :has-margin="false">
                <h2 class="title">
                    {{ props.title }}
                </h2>
            </title-component>
            <p class="text">
                {{ props.text }}
            </p>
        </div>
       <large-image-component :image="props.image"></large-image-component>
    </section>
</template>
<style scoped>
@import "@css/components/large-image-with-text-component.css";
</style>
