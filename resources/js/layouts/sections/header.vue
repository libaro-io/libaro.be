<script setup lang="ts">

import PrimaryMenu from "@layouts/sections/primary-menu.vue";
import SecondaryMenu from "@layouts/sections/secondary-menu.vue";
import {computed, Ref, ref} from "vue";
import LangSelector from "@layouts/sections/lang-selector.vue";
import {router} from "@inertiajs/vue3";
import HomeController from "@actions/App/Http/Controllers/HomeController";
import {Link} from "@inertiajs/vue3";

export interface HeaderOptions {
    fullWidthDescription?: boolean;
    background?: string | null;
    tags?: string[];
    isHome?: boolean;
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
        tags: props.options?.tags ?? [],
        isHome: props.options?.isHome ?? false,
    }
})

const menuOpen: Ref<boolean> = ref(false);

const toggleMenu = (): void => {
    menuOpen.value = !menuOpen.value;
    if (typeof document !== 'undefined') {
        if (menuOpen.value) {
            document.body.classList.add('overflow-hidden');
        }
        if (!menuOpen.value) {
            document.body.classList.remove('overflow-hidden');
        }
    }
}

const hasTags = computed(() => {
    return options.value.tags && options.value.tags.length > 0;
})

router.on('navigate', () => {
    menuOpen.value = false;
    if (typeof document !== 'undefined') {
        document.body.classList.remove('overflow-hidden');
    }
});
</script>
<template>
    <section
        :class="[
            'bg-primary-dark',
            'section-header',
            props.marginBottom ? 'margin-bottom' : '',
            options.isHome ? 'is-home' : '',
        ]">
        <img v-if="options.background"
             :src="options.background"
             fetchpriority="high"
             class="striped-bg"
             alt="header background">
        <div class="container">
            <header>
                <div class="logo">
                    <Link prefetch :href="HomeController()">
                        <img src="@assets/logos/libaro_logo_full_white_without_tagline.svg"
                             fetchpriority="high"
                             alt="logo"
                             width="210"
                             height="74">
                    </Link>
                </div>
                <button aria-label="Toggle menu" class="menu-button" @click="toggleMenu()">
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
                    <button
                        aria-label="Close menu"
                        class="close-button" @click="toggleMenu()">
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
            <div class="page-title-container">
                <div
                    v-if="props.pageTitle || props.pageSubTitle || props.pageDescription"
                    class="page-title">
                    <h2 v-if="props.pageSubTitle">{{ props.pageSubTitle }}</h2>
                    <h1 v-if="props.pageTitle">{{ props.pageTitle }}</h1>
                    <div class="text-tags">
                        <p v-if="props.pageDescription"
                           :class="{'full-width': options.fullWidthDescription}"
                        >{{ props.pageDescription }}</p>

                        <div class="tags"
                             v-if="hasTags">
                        <span
                            v-for="(tag, index) in options.tags" :key="index"
                            class="tag"
                        >{{ tag }}</span>
                        </div>

                    </div>
                </div>
                <div
                    v-if="options.isHome"
                    class="clock">
                    <img src="/images/clock_side.webp"
                         alt="clock"
                         width="468"
                         height="511"
                         fetchpriority="high">
                </div>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/layouts/sections/header.css";
</style>
