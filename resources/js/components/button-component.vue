<script setup lang="ts">

const props = withDefaults(defineProps<{
    text: string;
    color?: 'primary' | 'secondary' | 'tertiary';
    size?: 'small' | 'large';
    icon?: string;
    disabled?: boolean;
}>(), {
    color: 'primary',
    size: 'small',
    disabled: false,
});

</script>
<template>
    <section class="component-button-component">
        <button
            :disabled="props.disabled"
            :class="[`color-${props.color}`, `size-${props.size}`]"
        >
            {{ props.text }}

            <span v-if="props.icon" class="icon">
                <i :class="props.icon"></i>
            </span>
        </button>
    </section>
</template>
<style scoped>
@import "@css/components/button-component.css";
</style>
