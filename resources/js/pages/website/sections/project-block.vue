<script setup lang="ts">
import {ProjectBlockInterface} from "@interfaces/ProjectBlockInterface";
import {ProjectBlockTypeEnum} from "@enums/ProjectBlockTypeEnum";
import {ProjectInterface} from "@interfaces/ProjectInterface";

const props = defineProps<{
    project: ProjectInterface;
    block: ProjectBlockInterface;
}>()
</script>
<template>
    <section class="section-website-project-block">
        <div class="container" :class="[block.type]">
            <template v-if="block.type === ProjectBlockTypeEnum.TEXT">
                <div class="text" v-html="block.data.text"></div>
            </template>
            <template v-if="block.type === ProjectBlockTypeEnum.IMAGE">
                <img :src="'https://placehold.co/1000x400'" :alt="project.name">
            </template>
            <template v-if="block.type === ProjectBlockTypeEnum.IMAGE_TEXT">
                <img :src="block.data.image" :alt="project.name">
                <div class="text" v-html="block.data.text"></div>
            </template>
        </div>
    </section>
</template>
<style>
@import "@css/pages/website/sections/project-block.css";
</style>
