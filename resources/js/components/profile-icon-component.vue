<script setup lang="ts">

const props = defineProps<{
    imageSrc: string;
}>();

</script>
<template>
    <section class="component-profile-icon-component">
            <div class="image-container">
                <img loading="lazy" :src="props.imageSrc" alt="jennis">
            </div>
    </section>
</template>
<style scoped>
@import "@css/components/profile-icon-component.css";
</style>
