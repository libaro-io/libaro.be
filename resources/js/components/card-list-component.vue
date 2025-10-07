<script setup lang="ts">
import {computed, onMounted, onUnmounted, ref} from "vue";

const props = withDefaults(defineProps<{
    columns?: number
}>(),{
    columns: 3
});

const scrolled = ref(false);

const handleScroll = ():void => {
    scrolled.value = window.scrollY > 150;
};

onMounted(() => {
    window.addEventListener("scroll", handleScroll, { passive: true });
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
});

const classObject = computed(() => ({
    scrolled: scrolled.value,
    [`columns-${props.columns}`]: true
}))
</script>
<template>
    <section class="component-card-list-component">
        <div class="container">
            <div class="inner" :class="classObject">
                <slot></slot>
            </div>
        </div>
    </section>
</template>
<style>
@import "@css/components/card-list-component.css";
</style>
