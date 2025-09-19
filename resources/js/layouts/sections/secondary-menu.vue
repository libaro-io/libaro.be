<script setup lang="ts">

import {checkIfMenuItemIsActive, getFilteredMenu} from "@composables/UseMenuComposable";
import {Link} from "@inertiajs/vue3";
import {getTrans} from "@composables/UseTranslationHelper";
import {ref} from "vue";
import {MenuInterface} from "@interfaces/MenuInterface";
import HomeController from "../../actions/App/Http/Controllers/HomeController";

const props = defineProps<{
    type: 'header' | 'footer'
}>();

const secondaryMenu = ref<MenuInterface[]>([
    {
        weight: 1,
        text: 'menu.secondary.blog',
        url: HomeController(),
        visible: true,
    },
    {
        weight: 2,
        text: 'menu.secondary.docs',
        url: HomeController(),
        visible: true,
    },
    {
        weight: 3,
        text: 'menu.secondary.products',
        url: HomeController(),
        visible: true,
    }
]);

</script>
<template>
    <section
        :class="[
            'section-secondary-menu',
            props.type === 'header' ? 'section-secondary-menu-header' : 'section-secondary-menu-footer'
        ]">
        <nav>
            <ul>
                <li v-for="item in getFilteredMenu(secondaryMenu)" :key="item.text">
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
@import "@css/layouts/sections/secondary-menu.css";
</style>
