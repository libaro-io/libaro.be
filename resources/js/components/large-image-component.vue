<script setup lang="ts">
import {usePage, WhenVisible} from "@inertiajs/vue3";
import PageInterface from "@interfaces/PageInterface";
import {computed} from "vue";
import {getGifImage} from "@composables/UseGif";

const page = usePage<PageInterface>()

const props = withDefaults(defineProps<{
    image: string;
    alt?: string;
    lazyLoad?: boolean
    fetchPriority?: 'high' | 'low' | 'auto';
    loadWhenVisible?: boolean;
    aspectRatio?: 'aspect-auto' | 'aspect-video' | 'aspect-4/3';
    containImage?: boolean;
}>(), {
    lazyLoad: false,
    loadWhenVisible: false,
    aspectRatio: 'aspect-auto',
    containImage: false
})

const alt = computed(() => props.alt ?? page.props.pageProps.company.name)

const containImageClass = computed(() => props.containImage ? 'contain-image' : 'cover-image');

const getImageUrl = computed((): string => {
    return getGifImage(props.image);
});
</script>
<template>
    <section class="component-large-image-component">
        <div class="image-container" :class="[props.aspectRatio, containImageClass]">
            <img
                :src="getImageUrl"
                :alt="alt"
                :loading="props.lazyLoad ? 'lazy' : 'eager'"
                :fetchpriority="props.fetchPriority || 'auto'"
                v-if="!props.loadWhenVisible"
            >
            <WhenVisible v-else
                         data="getImageUrl"
                         :buffer="300">
                <img
                    :src="getImageUrl"
                    :alt="alt"
                    :loading="props.lazyLoad ? 'lazy' : 'eager'"
                    :fetchpriority="props.fetchPriority || 'auto'"
                >
            </WhenVisible>
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/large-image-component.css";
</style>
