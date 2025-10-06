<script setup lang="ts">
import ContactController from "@actions/App/Http/Controllers/ContactController";
import {Link} from "@inertiajs/vue3";
import {getTrans} from "@composables/UseTranslationHelper";
import ButtonComponent from "@components/button-component.vue";

</script>
<template>
    <section class="section-website-cta-contact">
        <img src="/images/header_striped.webp"
             class="bg-image"
             alt="contact background">
       <div class="container">
           <div class="grid">
               <div class="img">
                   <img alt="clock" loading="lazy" src="@assets/images/clock_front.webp">
               </div>
               <div class="content">
                   <h2>
                       {{ getTrans('sections.cta-contact.title') }}
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
