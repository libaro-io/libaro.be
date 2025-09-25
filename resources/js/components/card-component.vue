<script setup lang="ts">
import {computed} from "vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps<{
    link: string;
    title: string;
    subTitle?: string;
    category?: string;
    image?: string | null;
    tags?: string[];
}>()

const hasTagsOrCategory = computed(() => {
    return (props.tags && props.tags.length > 0) || props.category;
})
</script>
<template>
    <article class="component-card-component">
        <Link :href="props.link" prefetch>
            <div class="inner">
                <header>
                    <div class="tags"
                         v-if="hasTagsOrCategory">
                    <span
                        v-if="props.category"
                        class="tag"
                    >{{ props.category }}</span>
                        <span
                            v-if="props.tags"
                            v-for="(tag, index) in props.tags" :key="index"
                            class="tag"
                        >{{ tag }}</span>
                    </div>
                    <h2>{{ props.title }}</h2>
                    <h3 v-if="props.subTitle">{{ props.subTitle }}</h3>
                </header>

                <img v-if="props.image" :src="props.image" :alt="props.title">
            </div>
        </Link>
    </article>
</template>
<style scoped>
@import "@css/components/card-component.css";
</style>
