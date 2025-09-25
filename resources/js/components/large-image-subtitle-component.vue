<script setup lang="ts">
import LargeImageComponent from "@components/large-image-component.vue";

const props = withDefaults(defineProps<{
    image: string | null;
    title?: string;
    subtitle?: string;
    align?: 'left' | 'center' | 'right';
}>(), {align: 'left'});
</script>
<template>
    <section class="component-large-image-subtitle-component">
        <div class="img-container">
            <div class="container">
                <large-image-component class="image" v-if="props.image" :image="props.image"></large-image-component>
            </div>
        </div>
        <div class="content-container">
            <div class="container">
                <div class="background" :class="[`align-${props.align}`]">
                    <h3 v-if="props.title">{{ props.title }}</h3>
                    <p v-if="props.subtitle">{{ props.subtitle }}</p>

                    <slot></slot>
                </div>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/large-image-subtitle-component.css";
</style>
