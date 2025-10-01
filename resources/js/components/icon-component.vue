<script setup lang="ts">

const props = defineProps<{
    image: string;
    name: string;
}>();
</script>
<template>
    <section class="component-icon-component">
        <div class="image-container">
            <img :src="props.image" :alt="props.name">
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/icon-component.css";
</style>
