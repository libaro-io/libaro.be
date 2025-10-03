<script setup lang="ts">
import { getActiveLanguage, loadLanguageAsync } from "laravel-vue-i18n";
import { Ref, ref } from "vue";
import {router, usePage} from "@inertiajs/vue3";
import UpdateLangController from "@actions/App/Http/Controllers/UpdateLangController";
import PageInterface from "@interfaces/PageInterface";

const languages: string[] = ["nl", "en"];

const currentLanguage: Ref<string> = ref(getActiveLanguage());

const page = usePage<PageInterface>();

const setLanguage = (language: string): void => {
    const oldLanguage = getActiveLanguage();
    router.visit(UpdateLangController().url, {
        method: UpdateLangController().method,
        data: {
            language: language,
        },
        preserveScroll: true,
        preserveState: true,
    });

    const currentUrl = page.props.pageProps.url.href;
    const newUrl = currentUrl.replace(oldLanguage, language);
    router.visit(newUrl, {
        preserveScroll: true,
    });
    loadLanguageAsync(language);
    currentLanguage.value = language;
};
</script>
<template>
    <section class="section-lang-selector">
        <button
            @click="setLanguage(language)"
            :class="language === currentLanguage ? 'active' : ''"
            v-for="language in languages"
            :key="language"
        >
            <span>
                {{ language }}
            </span>
        </button>
    </section>
</template>
<style scoped>
@import "@css/layouts/sections/lang-selector.css";
</style>
