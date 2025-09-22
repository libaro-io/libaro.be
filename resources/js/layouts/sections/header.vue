<script setup lang="ts">

import PrimaryMenu from "@layouts/sections/primary-menu.vue";
import SecondaryMenu from "@layouts/sections/secondary-menu.vue";
import {computed, Ref, ref} from "vue";
import LangSelector from "@layouts/sections/lang-selector.vue";
import {router} from "@inertiajs/vue3";

export interface HeaderOptions {
    fullWidthDescription?: boolean;
    background?: string;
}

const props = withDefaults(defineProps<{
    pageTitle?: string;
    pageSubTitle?: string;
    pageDescription?: string | null;
    marginBottom?: boolean;
    options: HeaderOptions;
}>(), {
    marginBottom: true,
});

//using this to have default values for the options
const options = computed((): HeaderOptions => {
    return {
        fullWidthDescription: props.options?.fullWidthDescription ?? false,
        background: props.options?.background ?? "/images/header_striped.webp",
    }
})

const menuOpen: Ref<boolean> = ref(false);

const toggleMenu = () => {
    menuOpen.value = !menuOpen.value;
    if (menuOpen.value) {
        document.body.classList.add('overflow-hidden');
    }
    if (!menuOpen.value) {
        document.body.classList.remove('overflow-hidden');
    }
}

router.on('navigate', () => {
    menuOpen.value = false;
    document.body.classList.remove('overflow-hidden');
});

</script>
<template>
    <section
        :style="{
            'background-image': 'url(' + options.background + ')',
        }"
        :class="[
            'section-header',
            props.marginBottom ? 'margin-bottom' : ''
        ]">
        <div class="container">
            <header>
                <div class="logo">
                    <img src="@assets/logos/libaro_logo_full_white_without_tagline.svg" alt="logo">
                </div>
                <button class="menu-button" @click="toggleMenu()">
                    <i
                        :class="[

                           'fa-solid',
                           menuOpen ? 'fa-xmark' : 'fa-bars'
                        ]"
                    ></i>
                </button>
                <div
                    :class="[
                       'menus',
                       menuOpen ? 'open' : ''
                   ]"
                >
                    <button class="close-button" @click="toggleMenu()">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="top">
                        <secondary-menu type="header"></secondary-menu>
                        <lang-selector></lang-selector>
                    </div>
                    <primary-menu type="header"></primary-menu>
                </div>
                <div
                    class="overlay"
                    @click="toggleMenu()"
                    v-if="menuOpen"
                >
                </div>
            </header>
            <div class="page-title">
                <h2 v-if="props.pageSubTitle">{{ props.pageSubTitle }}</h2>
                <h1 v-if="props.pageTitle">{{ props.pageTitle }}</h1>

                <p v-if="props.pageDescription"
                   :class="{'full-width': options.fullWidthDescription}">{{ props.pageDescription }}</p>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/layouts/sections/header.css";
</style>
