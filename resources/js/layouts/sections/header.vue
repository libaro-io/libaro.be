<script setup lang="ts">

import PrimaryMenu from "@layouts/sections/primary-menu.vue";
import SecondaryMenu from "@layouts/sections/secondary-menu.vue";

const props = withDefaults(defineProps<{
    background?: string;
}>(), {
    background: "@assets/images/header_striped.webp"
});

</script>
<template>
    <section

        class="section-header">
       <div class="container">
           <header>
               <div class="logo">
                   <img src="@assets/logos/libaro_logo_full_white_without_tagline.svg" alt="logo">
               </div>
               <div class="menus">
                   <div class="top">
                       <secondary-menu type="header"></secondary-menu>
                   </div>
                   <primary-menu type="header"></primary-menu>
               </div>
           </header>
       </div>
    </section>
</template>
<style scoped>
@import "@css/layouts/sections/header.css";
</style>
