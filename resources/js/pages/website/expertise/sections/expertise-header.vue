<script setup lang="ts">

import {TranslationKey} from "../../../../translations/lang-keys";
import {getTrans} from "@composables/UseTranslationHelper";
import {computed} from "vue";
import {getGifImage} from "@composables/UseGif";

const props = defineProps<{
    title: TranslationKey;
    description: TranslationKey | TranslationKey[];
    image: string;
}>();

const getImageUrl = computed(():string => {
    return getGifImage(props.image);
});

</script>
<template>
    <section class="section-website-expertise-expertise-header">
        <div class="container">
            <div class="text">
                <h1>{{getTrans(props.title)}}</h1>
                <div class="descriptions" v-if="Array.isArray(props.description)">
                    <p v-for="description in props.description" :key="description">
                        {{getTrans(description)}}
                    </p>
                </div>
                <p v-else>
                    {{getTrans(props.description)}}
                </p>
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
