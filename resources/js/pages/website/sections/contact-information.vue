<script setup lang="ts">
import ProfileIconComponent from "@components/profile-icon-component.vue";
import bert from "@assets/images/bert.webp";
import {usePage} from "@inertiajs/vue3";
import PageInterface from "@interfaces/PageInterface";

const page = usePage<PageInterface>();

</script>
<template>
    <section class="section-website-contact-information">
        <div class="information">
            <profile-icon-component class="image" :image-src="bert"></profile-icon-component>
            <div class="text">
                <p class="name">Bert Clybouw</p>
                <a :href="'mailto:'+ page.props.pageProps.company.email"> {{ page.props.pageProps.company.email }} </a>
                <a :href="'tel:'+ page.props.pageProps.company.phone"> {{ page.props.pageProps.company.phone }} </a>
            </div>
        </div>
        <address>
            <p> {{ page.props.pageProps.company.address.street }} {{ page.props.pageProps.company.address.number }} </p>
            <p> {{ page.props.pageProps.company.address.zip }} {{ page.props.pageProps.company.address.city }} </p>
        </address>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/contact-information.css";
</style>
