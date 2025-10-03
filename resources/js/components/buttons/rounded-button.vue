<script setup lang="ts">

const props = defineProps<{
    disabled?: boolean;
    ariaLabel?: string;
}>();

</script>
<template>
    <section class="component-buttons-rounded-button">
        <button
            :aria-label="props.ariaLabel"
            :disabled="props.disabled"
        >
            <slot></slot>
        </button>
    </section>
</template>
<style scoped>
@import "@css/components/buttons/rounded-button.css";
</style>
