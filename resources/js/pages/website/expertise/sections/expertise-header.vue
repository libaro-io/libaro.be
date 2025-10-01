<script setup lang="ts">

import {TranslationKey} from "../../../../translations/lang-keys";
import {getTrans} from "@composables/UseTranslationHelper";

const props = defineProps<{
    title: TranslationKey;
    description: TranslationKey;
    image: string;
}>();
</script>
<template>
    <section class="section-website-expertise-expertise-header">
        <div class="container">
            <div class="text">
                <h1>{{getTrans(props.title)}}</h1>
                <p>{{ getTrans(props.description)}}</p>
            </div>
            <div class="image">
                <img
                    :src="props.image"
                    alt=""
                >
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/expertise/sections/expertise-header.css";
</style>
