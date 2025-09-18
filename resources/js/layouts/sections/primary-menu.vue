<script setup lang="ts">

import {checkIfMenuItemIsActive, getFilteredMenu} from "@composables/UseMenuComposable";
import {Link} from "@inertiajs/vue3";
import {getTrans} from "@composables/UseTranslationHelper";
import {ref} from "vue";
import {MenuInterface} from "@interfaces/MenuInterface";
import HomeController from "../../actions/App/Http/Controllers/HomeController";
import ContactController from "../../actions/App/Http/Controllers/ContactController";

const primaryMenu = ref<MenuInterface[]>([
    {
        weight: 1,
        text: 'menu.primary.home',
        url: HomeController(),
        visible: true,
    },
    {
        weight: 2,
        text: 'menu.primary.contact',
        url: ContactController(),
        visible: true,
    }
]);

</script>
<template>
    <section class="section-primary-menu">
       <nav>
           <ul>
               <li v-for="item in getFilteredMenu(primaryMenu)" :key="item.text">
                   <Link prefetch
                         :class="checkIfMenuItemIsActive(item) ? 'active' : ''"
                         :href="item.url.url"> {{ getTrans(item.text) }}
                   </Link>
               </li>
           </ul>
       </nav>
    </section>
</template>
<style scoped>
@import "@css/layouts/sections/primary-menu.css";
</style>
