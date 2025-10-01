<script setup lang="ts">

const props = defineProps<{
    disabled?: boolean;
}>();

</script>
<template>
    <section class="component-buttons-rounded-button">
        <button
            :disabled="props.disabled"
        >
            <slot></slot>
        </button>
    </section>
</template>
<style scoped>
@import "@css/components/buttons/rounded-button.css";
</style>
