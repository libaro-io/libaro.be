<script setup lang="ts">
import { BlockInterface } from "@interfaces/BlockInterface";
import { BlockTypeEnum } from "@enums/BlockTypeEnum";
import LargeImageComponent from "@components/large-image-component.vue";
import { useS3Image } from "@composables/useS3Image";

const props = defineProps<{
    alt: string;
    block: BlockInterface;
}>();
</script>
<template>
    <section class="section-website-content-block">
        <div class="container" :class="[props.block.type]">
            <template v-if="props.block.type === BlockTypeEnum.TEXT">
                <div class="text" v-html="props.block.data.text"></div>
            </template>

            <template v-if="props.block.type === BlockTypeEnum.IMAGE">
                <large-image-component
                    v-if="props.block.data.image"
                    :image="useS3Image(props.block.data.image) ?? ''"
                    :alt="props.alt"
                />
            </template>

            <template v-if="props.block.type === BlockTypeEnum.IMAGE_TEXT">
                <div class="grid-layout">
                    <large-image-component
                        v-if="props.block.data.image"
                        :image="useS3Image(props.block.data.image) ?? ''"
                        :alt="props.alt"
                        :class="{
                            'order-2': props.block.data.layout == 'text_image',
                        }"
                    />
                    <div class="text" v-html="props.block.data.text"></div>
                </div>
            </template>

            <template v-if="props.block.type === BlockTypeEnum.NUMBER_TEXT">
                <div class="grid-layout">
                    <div class="title">
                        <div class="number-wrapper">
                            <h4>0{{ props.block.data.number }}.</h4>
                        </div>
                        <h2>{{ props.block.data.title }}</h2>
                    </div>
                    <div class="text" v-html="props.block.data.text"></div>
                </div>
            </template>

            <template v-if="props.block.type === BlockTypeEnum.LOGO_TEXT">
                <div class="grid-layout">
                    <div class="img-wrapper">
                        <img
                            v-if="props.block.data.image"
                            :src="useS3Image(props.block.data.image) ?? ''"
                            :alt="props.alt"
                            class="logo"
                        />
                    </div>
                    <div class="text" v-html="props.block.data.text"></div>
                </div>
            </template>
            <template v-if="props.block.type === BlockTypeEnum.CARDS">
                <div class="grid-layout">
                    <template
                        v-for="(card, index) in props.block.data.cards"
                        :key="index"
                    >
                        <div class="card">
                            <div class="img-wrapper" v-if="card.image">
                                <img
                                    :src="useS3Image(card.image) ?? ''"
                                    :alt="props.alt"
                                    class="logo"
                                />
                            </div>
                            <h3>{{ card.title }}</h3>
                            <div class="text" v-html="card.text"></div>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </section>
</template>
<style>
@import "@css/pages/website/sections/content-block.css";
</style>
