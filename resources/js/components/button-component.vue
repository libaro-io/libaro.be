<script setup lang="ts">

const props = defineProps<{
    text: string;
    disabled?: boolean;
}>();

</script>
<template>
    <section class="component-button-component">
       <button
           :disabled="props.disabled"
           >
           {{ props.text }}
       </button>
    </section>
</template>
<style scoped>
@import "@css/components/button-component.css";
</style>
