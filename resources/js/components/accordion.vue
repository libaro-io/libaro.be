<script setup lang="ts">
import {ref} from "vue";

const props = defineProps<{
    items: { title: string; description: string }[];
}>()

const activeItem = ref<number | null>(null);
</script>
<template>
    <section class="component-accordion">
        <div class="accordion" v-for="(item, index) in items" :key="index">
            <label @click="activeItem = index">
                {{ item.title }}

                <i class="fa-solid fa-chevron-down" v-if="activeItem === index"></i>
                <i class="fa-solid fa-chevron-right" v-else></i>
            </label>
            <div class="accordion-content" :class="{'active': activeItem === index}">
                <p v-html="item.description"></p>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/accordion.css";
</style>
