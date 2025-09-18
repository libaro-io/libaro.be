<script setup lang="ts">
import PrimaryMenu from "@layouts/sections/primary-menu.vue";
import SecondaryMenu from "@layouts/sections/secondary-menu.vue";
</script>
<template>
    <section class="section-navigation-footer container">
       <div class="logo">
           <img src="@assets/logos/libaro_logo_full_blue_without_tagline.png" alt="logo">
       </div>
        <div class="menu">
            <secondary-menu></secondary-menu>
            <primary-menu></primary-menu>
        </div>
    </section>
</template>
<style scoped>
@import "@css/layouts/sections/navigation-footer.css";
</style>
