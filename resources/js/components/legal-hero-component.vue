<script setup lang="ts">
const props = withDefaults(defineProps<{
    eyebrow: string;
    title: string;
    lead?: string;
}>(), {
    lead: '',
});
</script>
<template>
    <section class="component-legal-hero">
        <div class="hero-circles">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
        </div>
        <div class="container">
            <div class="hero-inner">
                <span class="eyebrow" v-text="props.eyebrow"></span>
                <h1 v-text="props.title"></h1>
                <p
                    v-if="props.lead"
                    class="lead"
                    v-text="props.lead"
                ></p>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/legal-hero-component.css";
</style>
