<script setup lang="ts">
import ContactController from "@actions/App/Http/Controllers/ContactController";
import {Link} from "@inertiajs/vue3";
import {getTrans} from "@composables/UseTranslationHelper";
import ButtonComponent from "@components/button-component.vue";
import {ref, Ref} from "vue";
import {TranslationKey} from "../../../translations/lang-keys";

const props = withDefaults(defineProps<{
    title?: TranslationKey;
    negativeMargin?: boolean;
}>(), {
    title: 'sections.cta-contact.title',
    negativeMargin: false,
});

const clockRef: Ref<HTMLImageElement | null> = ref(null);
let animationInterval: number | null = null;
let currentRotation:number = 0;
let rotationSpeed:number = 0.2;

const handleMouseEnter = (): void => {
    if (animationInterval){
        return;
    }
    animationInterval = window.setInterval(() => {
        if (clockRef.value) {
            currentRotation += rotationSpeed;
            clockRef.value.style.transform = `rotate(${currentRotation}deg)`;
            rotationSpeed += 0.1; // Increase speed gradually
        }
    }, 16); // ~60fps
}

const handleMouseLeave = (): void => {
    if (animationInterval) {
        clearInterval(animationInterval);
        animationInterval = null;
    }
    rotationSpeed = 0.2;

    // Smoothly return to 0 degrees
    if (clockRef.value) {
        clockRef.value.style.transform = 'rotate(0deg)';
        currentRotation = 0;
    }
}

</script>
<template>
    <section class="section-website-cta-contact" :class="{'negative-margin': props.negativeMargin}">
        <img src="/images/header_striped.webp"
             class="bg-image"
             alt="header">
       <div class="container">
           <div class="grid">
               <div class="img">
                   <img ref="clockRef" alt="clock" loading="lazy" src="@assets/images/clock_front.webp">
               </div>
               <div class="content">
                   <h2>
                       {{ getTrans(props.title) }}
                   </h2>
                   <p>
                       {{ getTrans('sections.cta-contact.description') }}
                   </p>
                   <Link :href="ContactController()">
                       <button-component
                           :text="getTrans('sections.cta-contact.button')"
                           color="tertiary"
                           size="large"
                           icon="fa-solid fa-chevron-right"
                           @mouseenter="handleMouseEnter"
                           @mouseleave="handleMouseLeave"
                       ></button-component>
                   </Link>
               </div>
           </div>
       </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/cta-contact.css";
</style>
