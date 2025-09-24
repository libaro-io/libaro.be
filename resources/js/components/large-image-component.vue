<script setup lang="ts">
import {usePage} from "@inertiajs/vue3";
import PageInterface from "@interfaces/PageInterface";
import {computed} from "vue";

const page = usePage<PageInterface>()

const props = defineProps<{
    image: string;
    alt?: string;
    fetchPriority?: 'high' | 'low' | 'auto';
}>()

const alt = computed(() => props.alt ?? page.props.pageProps.company.name)
</script>
<template>
    <section class="component-large-image-component">
        <div class="image-container">
            <img 
                :src="props.image" 
                :alt="alt"
                :fetchpriority="props.fetchPriority || 'auto'"
            >
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/large-image-component.css";
</style>
