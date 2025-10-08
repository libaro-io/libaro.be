<script setup lang="ts">
import {ref, computed} from "vue";

const model = defineModel<string>();
const isFocused = ref(false);

const props = withDefaults(defineProps<{
    label?: string,
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
    <section class="component-forms-textarea-component">
        <div class="textarea-container">
            <label 
                v-if="props.label"
                :class="{'floating': isLabelFloating}"
            >
                {{ props.label }} <span v-if="props.required" class="required">*</span>
            </label>
            <textarea 
                v-model="model" 
                :name="props.name" 
                :required="props.required"
                @focus="handleFocus"
                @blur="handleBlur"
            ></textarea>
        </div>
        <p v-if="props.error" class="error">{{ props.error }}</p>
    </section>
</template>
<style scoped>
@import "@css/components/forms/textarea-component.css";
</style>
