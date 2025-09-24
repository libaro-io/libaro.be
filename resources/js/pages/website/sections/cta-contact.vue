<script setup lang="ts">
import ContactController from "@actions/App/Http/Controllers/ContactController";
import {Link} from "@inertiajs/vue3";
import {getTrans} from "@composables/UseTranslationHelper";

</script>
<template>
    <section class="section-website-cta-contact">
       <div class="container">
           <div class="grid">
               <div class="img">
                   <img alt="clock" src="@assets/images/clock_front.webp">
               </div>
               <div class="content">
                   <h2>
                       {{ getTrans('sections.cta-contact.title') }}
                   </h2>
                   <p>
                       {{ getTrans('sections.cta-contact.description') }}
                   </p>
                   <Link class="button" :href="ContactController()">
                       <span class="text">{{ getTrans('sections.cta-contact.button') }}</span>
                       <span class="icon">
                           <i class="fa-solid fa-chevron-right"></i>
                       </span>
                   </Link>
               </div>
           </div>
       </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/cta-contact.css";
</style>
