<script setup lang="ts">
import {ProjectBlockInterface} from "@interfaces/ProjectBlockInterface";
import {ProjectBlockTypeEnum} from "@enums/ProjectBlockTypeEnum";
import {ProjectInterface} from "@interfaces/ProjectInterface";
import LargeImageComponent from "@components/large-image-component.vue";

const props = defineProps<{
    project: ProjectInterface;
    block: ProjectBlockInterface;
}>();
</script>
<template>
    <section class="section-website-project-block">
        <div class="container" :class="[block.type]">
            <template v-if="block.type === ProjectBlockTypeEnum.TEXT">
                <div class="text" v-html="block.data.text"></div>
            </template>

            <template v-if="block.type === ProjectBlockTypeEnum.IMAGE">
                <large-image-component
                    image="https://placehold.co/1000x400"
                    :alt="project.name"
                />
            </template>

            <template v-if="block.type === ProjectBlockTypeEnum.IMAGE_TEXT">
                <div class="grid-layout">
                    <large-image-component
                        image="https://placehold.co/600x400"
                        :alt="project.name"
                        :class="{'order-2': block.data.layout == 'text_image'}"
                    />
                    <div class="text"
                         v-html="block.data.text"
                    ></div>
                </div>
            </template>

            <template v-if="block.type === ProjectBlockTypeEnum.NUMBER_TEXT">
                <div class="grid-layout">
                    <div class="title">
                        <div class="number-wrapper">
                            <h4>0{{ block.data.number }}.</h4>
                        </div>
                        <h2>{{ block.data.title }}</h2>
                    </div>
                    <div class="text"
                         v-html="block.data.text"
                    ></div>
                </div>
            </template>

            <template v-if="block.type === ProjectBlockTypeEnum.LOGO_TEXT">
                <div class="grid-layout">
                    <div class="img-wrapper">
                        <img
                            :src="'https://placehold.co/600x400'"
                            :alt="project.name"
                            class="logo"
                        />
                    </div>
                    <div class="text"
                         v-html="block.data.text"
                    ></div>
                </div>
            </template>
        </div>
    </section>
</template>
<style>
@import "@css/pages/website/sections/project-block.css";
</style>
