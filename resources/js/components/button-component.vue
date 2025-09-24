<script setup lang="ts">

const props = withDefaults(defineProps<{
    text: string;
    color?: 'primary' | 'secondary';
    disabled?: boolean;
}>(),{
    color: 'primary',
    disabled: false,
});

</script>
<template>
    <section class="component-button-component">
       <button
           :disabled="props.disabled"
              :class="[`color-${props.color}`]"
           >
           {{ props.text }}
       </button>
    </section>
</template>
<style scoped>
@import "@css/components/button-component.css";
</style>
