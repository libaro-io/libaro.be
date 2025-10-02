<script setup lang="ts">

const props = withDefaults(defineProps<{
    image: string;
    name: string;
    iconSize?: 'small' | 'large';
}>(), {
    iconSize: 'large'
});
</script>
<template>
    <section
        :class="[
            'component-icon-component',
            props.iconSize === 'small' ? 'icon-small' : 'icon-large'
           ]">
        <div class="image-container">
            <img :src="props.image" :alt="props.name">
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/icon-component.css";
</style>
