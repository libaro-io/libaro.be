<script setup lang="ts">
import PrimaryMenu from "@layouts/sections/primary-menu.vue";
import SecondaryMenu from "@layouts/sections/secondary-menu.vue";
import {Link} from "@inertiajs/vue3";
import HomeController from "../../actions/App/Http/Controllers/HomeController";
</script>
<template>
    <section class="section-navigation-footer container">
       <div class="logo">
           <Link :href="HomeController()">
               <img src="@assets/logos/libaro_logo_full_blue_without_tagline.png" alt="logo">
           </Link>
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
