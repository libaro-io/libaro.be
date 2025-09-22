<script setup lang="ts">

const props = defineProps<{
    imageSrc: string;
}>();

</script>
<template>
    <section class="component-profile-icon-component">
            <div class="image-container">
                <img :src="props.imageSrc" alt="bert">
            </div>
    </section>
</template>
<style scoped>
@import "@css/components/profile-icon-component.css";
</style>
