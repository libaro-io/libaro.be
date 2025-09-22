<script setup lang="ts">

const model = defineModel<string>();

const props = withDefaults(defineProps<{
    label?: string,
    type?: string,
    name?: string,
    placeholder?: string,
    required?: boolean,
}>(), {
    required: false,
});

</script>
<template>
    <section class="component-forms-input-component">
        <label v-if="props.label">{{ props.label }}</label>
        <div class="input-container">
            <input v-model="model" :type="props.type" :name="props.name" :placeholder="props.placeholder" :required="props.required">
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/forms/input-component.css";
</style>
