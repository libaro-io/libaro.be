<script setup lang="ts">
import LargeImageComponent from "@components/large-image-component.vue";

const props = defineProps< {
    image: string;
    subtitle? : string;
}>();
</script>
<template>
    <section class="component-large-image-subtitle-component">
        <div class="container">
            <large-image-component class="image" :image="props.image"></large-image-component>
            <p v-if="props.subtitle">{{ props.subtitle }}</p>
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/large-image-subtitle-component.css";
</style>
