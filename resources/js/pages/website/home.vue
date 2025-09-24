<script setup lang="ts">
import Website from "@layouts/website.vue";
import CtaContact from "@pages/website/sections/cta-contact.vue";
import OurClients from "@pages/website/sections/our-clients.vue";
import {PaginationInterface} from "@interfaces/PaginationInterface";
import {HomeClientInterface} from "@interfaces/HomeClientInterface";

const props = defineProps<{
    clients?: PaginationInterface<HomeClientInterface>;
}>();

</script>
<template>
    <website meta-title="Digital Innovation Partner">
        <div id="page-website-home">
            <our-clients :clients="props.clients"></our-clients>
            <cta-contact></cta-contact>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/home.css";
</style>
