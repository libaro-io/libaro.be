<script setup lang="ts">
import {computed, onMounted, onUnmounted, ref} from "vue";
import RoundedButton from "@components/buttons/rounded-button.vue";

const sliderRef = ref<HTMLElement | null>(null);
const scrollPosition = ref(0);

const updateScrollPosition = ():void => {
    if (sliderRef.value) {
        scrollPosition.value = sliderRef.value.scrollLeft;
    }
};

onMounted(() => {
    if (sliderRef.value) {
        sliderRef.value.addEventListener('scroll', updateScrollPosition);
        updateScrollPosition();
    }
});

onUnmounted(() => {
    if (sliderRef.value) {
        sliderRef.value.removeEventListener('scroll', updateScrollPosition);
    }
});

const scrollLeft = ():void => {
    if (sliderRef.value) {
        const scrollAmount = sliderRef.value.clientWidth * 0.8;
        sliderRef.value.scrollBy({
            left: -scrollAmount,
            behavior: 'smooth'
        });
    }
};

const scrollRight = ():void => {
    if (sliderRef.value) {
        const scrollAmount = sliderRef.value.clientWidth * 0.8;
        sliderRef.value.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    }
};

const canScrollLeft = computed(():boolean => {
    return scrollPosition.value > 0;
});

const canScrollRight = computed(():boolean => {
    if (!sliderRef.value) {
        return false;
    }
    return scrollPosition.value < sliderRef.value.scrollWidth - sliderRef.value.clientWidth;
});

</script>
<template>
    <section class="component-slider-component">
       <div class="slider-container">
           <div ref="sliderRef" class="slider">
               <slot></slot>
           </div>
       </div>
        <div class="buttons">
            <rounded-button
                @click="scrollLeft"
                :disabled="!canScrollLeft"
            >
                <i class="fa-solid fa-chevron-left"></i>
            </rounded-button>
            <rounded-button
                @click="scrollRight"
                :disabled="!canScrollRight"
            >
                <i class="fa-solid fa-chevron-right"></i>
            </rounded-button>
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/slider-component.css";
</style>
