<script setup lang="ts">

import {TranslationKey} from "../../../../translations/lang-keys";
import {getTrans} from "@composables/UseTranslationHelper";
import {computed} from "vue";
import {DateTime} from "luxon";

const props = defineProps<{
    title: TranslationKey;
    description: TranslationKey;
    image: string;
}>();

const getImageUrl = computed(():string => {
    let imageUrl = props.image;
    if(props.image.endsWith('.gif')){
        imageUrl += '?v='+DateTime.now().toSeconds();
    }
    return imageUrl;
});

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
                    :src="getImageUrl"
                    alt=""
                >
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/expertise/sections/expertise-header.css";
</style>
