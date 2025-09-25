<script setup lang="ts">

const props = withDefaults(defineProps<{
    hasMargin?: boolean;
}>(), {
    hasMargin: true,
})

</script>
<template>
    <section
        :class="[
            props.hasMargin ? 'has-margin' : '',
            'component-title-component'
        ]"
       >
        <slot></slot>
    </section>
</template>
<style scoped>
@import "@css/components/title-component.css";
</style>
