<script setup lang="ts">

import {checkIfMenuItemIsActive, getFilteredMenu} from "@composables/UseMenuComposable";
import {Link} from "@inertiajs/vue3";
import {getTrans} from "@composables/UseTranslationHelper";
import {ref} from "vue";
import {MenuInterface} from "@interfaces/MenuInterface";
import BlogController from "@actions/App/Http/Controllers/BlogController";
import ProductController from "@actions/App/Http/Controllers/ProductController";

const props = defineProps<{
    type: 'header' | 'footer'
}>();

const secondaryMenu = ref<MenuInterface[]>([
    {
        text: 'menu.secondary.blog',
        url: BlogController(),
        visible: true,
    },
    {
        text: 'menu.secondary.products',
        url: ProductController(),
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
                          :href="item.url?.url"> {{ getTrans(item.text) }}
                    </Link>
                </li>
            </ul>
        </nav>
    </section>
</template>
<style scoped>
@import "@css/layouts/sections/secondary-menu.css";
</style>
