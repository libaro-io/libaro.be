<script setup lang="ts">
const props = defineProps<{
    title: string;
    subTitle?: string;
    category?: string;
}>()
</script>
<template>
    <article class="component-card-component">
        <div class="inner">
            <header>
                <div class="tags">
                    <span
                        v-if="props.category"
                        class="tag"
                    >{{ props.category }}</span>
                </div>
                <h2>{{ props.title }}</h2>
                <h3 v-if="props.subTitle">{{ props.subTitle }}</h3>
            </header>

            <img src="https://placehold.co/400x600" :alt="props.title">
        </div>
    </article>
</template>
<style scoped>
@import "@css/components/card-component.css";
</style>
