<script setup lang="ts">

const props = withDefaults(defineProps<{
    hasMargin?: boolean;
}>(), {
    hasMargin: true,
})

</script>
<template>
    <h2
        :class="[
            props.hasMargin ? 'has-margin' : '',
            'component-title-component'
        ]"
       >
        <slot></slot>
    </h2>
</template>
<style scoped>
@import "@css/components/title-component.css";
</style>
