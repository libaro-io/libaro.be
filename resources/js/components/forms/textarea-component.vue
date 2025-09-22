<script setup lang="ts">

const model = defineModel<string>();

const props = withDefaults(defineProps<{
    label?: string,
    name?: string,
    placeholder?: string,
    required?: boolean,
    error?: string,
}>(), {
    required: false,
});

</script>
<template>
    <section class="component-forms-textarea-component">
        <label v-if="props.label">{{ props.label }}</label>
        <div class="textarea-container">
            <textarea v-model="model" :name="props.name" :placeholder="props.placeholder" :required="props.required"></textarea>
        </div>
        <p v-if="props.error" class="error">{{ props.error }}</p>
    </section>
</template>
<style scoped>
@import "@css/components/forms/textarea-component.css";
</style>
