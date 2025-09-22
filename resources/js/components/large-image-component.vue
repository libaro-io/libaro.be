<script setup lang="ts">
const props = defineProps< {
    image: string;
}>();
</script>
<template>
    <section class="component-large-image-component">
       <div class="image-container">
           <img :src="props.image" alt="large image">
       </div>
    </section>
</template>
<style scoped>
@import "@css/components/large-image-component.css";
</style>
