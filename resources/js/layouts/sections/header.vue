<script setup lang="ts">

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
                   menus
               </div>
           </header>
       </div>
    </section>
</template>
<style scoped>
@import "@css/layouts/sections/header.css";
</style>
