<script setup lang="ts">
import { onMounted, onUnmounted, ref } from "vue";

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
</script>
<template>
    <section class="component-card-list-component">
        <div class="container">
            <div class="inner" :class="{ scrolled: scrolled }">
                <slot></slot>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/card-list-component.css";
</style>
