<script setup lang="ts">

const model = defineModel<string>();

const props = withDefaults(defineProps<{
    label?: string,
    type?: string,
    name?: string,
    placeholder?: string,
    required?: boolean,
    error?: string,
}>(), {
    required: false,
});

</script>
<template>
    <section class="component-forms-input-component">
        <label v-if="props.label">{{ props.label }} <span v-if="props.required" class="required">*</span></label>
        <div class="input-container">
            <input
                v-model="model"
                :type="props.type"
                :name="props.name"
                :placeholder="props.placeholder"
                :required="props.required"
            >
        </div>
        <p v-if="props.error" class="error">{{ props.error }}</p>
    </section>
</template>
<style scoped>
@import "@css/components/forms/input-component.css";
</style>
