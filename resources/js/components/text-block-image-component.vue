<script setup lang="ts">

import {TextBlockImageInterface} from "@interfaces/TextBlockImageInterface";
import {getTrans} from "@composables/UseTranslationHelper";
import LargeImageComponent from "@components/large-image-component.vue";

const props = withDefaults(defineProps<{
    textBlockImage: TextBlockImageInterface;
    imageSide?: 'left' | 'right';
}>(),{
    imageSide: 'left'
});

</script>
<template>
    <section
        :class="[
            'component-text-block-image-component',
            props.imageSide === 'left' ? 'image-left' : 'image-right'
        ]"
    >
        <div class="content">
            <div class="texts">
                <h3
                    v-if="props.textBlockImage.subTitle"
                    class="subtitle">
                    {{ getTrans(props.textBlockImage.subTitle) }}
                </h3>
                <h2 class="title">
                    {{ getTrans(props.textBlockImage.title) }}
                </h2>
                <div class="text">
                    <p
                        v-html="getTrans(text)"
                        v-for="(text, index) in props.textBlockImage.texts"
                        :key="index"
                    ></p>
                </div>
            </div>
            <large-image-component
                class="image"
                :image="props.textBlockImage.image"
            ></large-image-component>
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/text-block-image-component.css";
</style>
