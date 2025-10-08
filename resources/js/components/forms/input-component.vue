<script setup lang="ts">
import {ref, computed} from "vue";

const model = defineModel<string>();
const isFocused = ref(false);

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

const isLabelFloating = computed(() => {
    return isFocused.value || (model.value && model.value.length > 0);
});

const handleFocus = (): void => {
    isFocused.value = true;
}

const handleBlur = (): void => {
    isFocused.value = false;
}

</script>
<template>
    <section class="component-forms-input-component">
        <div class="input-container">
            <label 
                v-if="props.label"
                :class="{'floating': isLabelFloating}"
            >
                {{ props.label }} <span v-if="props.required" class="required">*</span>
            </label>
            <input
                v-model="model"
                :type="props.type"
                :name="props.name"
                :required="props.required"
                @focus="handleFocus"
                @blur="handleBlur"
            >
        </div>
        <p v-if="props.error" class="error">{{ props.error }}</p>
    </section>
</template>
<style scoped>
@import "@css/components/forms/input-component.css";
</style>
