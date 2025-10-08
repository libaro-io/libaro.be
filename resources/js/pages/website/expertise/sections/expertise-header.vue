<script setup lang="ts">

import {TranslationKey} from "../../../../translations/lang-keys";
import {getTrans} from "@composables/UseTranslationHelper";
import {getGifImage} from "@composables/UseGif";

const props = defineProps<{
    title: TranslationKey;
    description: TranslationKey | TranslationKey[];
    image: string;
}>();

// Generate the URL once when the component is created, not as a computed property
const getImageUrl = getGifImage(props.image);

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
                    v-if="getImageUrl"
                    :src="getImageUrl"
                    :alt="getTrans(props.title)"
                    fetchpriority="high"
                >
            </div>
        </div>
    </section>
</template>
