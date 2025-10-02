<script setup lang="ts">

import {TextBlockImageInterface} from "@interfaces/TextBlockImageInterface";
import LargeImageComponent from "@components/large-image-component.vue";
import TitleComponent from "@components/title-component.vue";
import SubTitleComponent from "@components/sub-title-component.vue";

const props = withDefaults(defineProps<{
    textBlockImage: TextBlockImageInterface;
    imageSide?: 'left' | 'right';
    fetchPriority?: 'high' | 'low' | 'auto';
}>(),{
    imageSide: 'left',
    fetchPriority: 'auto',
    title: '',
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
                <sub-title-component v-if="props.textBlockImage.subTitle">
                    <h3
                        class="subtitle">
                        {{ props.textBlockImage.subTitle }}
                    </h3>
                </sub-title-component>
                <title-component>
                    <h2 class="title">
                        {{ props.textBlockImage.title }}
                    </h2>
                </title-component>

                <div class="text">
                    <p
                        v-html="text"
                        v-for="(text, index) in props.textBlockImage.texts"
                        :key="index"
                    ></p>
                </div>
            </div>
            <large-image-component
                class="image"
                :image="props.textBlockImage.image"
                :fetch-priority="props.fetchPriority"
            ></large-image-component>
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/text-block-image-component.css";
</style>
