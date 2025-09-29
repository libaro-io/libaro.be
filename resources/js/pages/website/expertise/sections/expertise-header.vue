<script setup lang="ts">

const props = defineProps<{
    title: string;
    description: string;
    image: string;
}>();

</script>
<template>
    <section class="section-website-expertise-expertise-header">
        <div class="container">
            <div class="text">
                <h1>{{props.title}}</h1>
                <p>{{props.description}}</p>
            </div>
            <div class="image">
                <img :src="props.image" alt="">
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/expertise/sections/expertise-header.css";
</style>
