<script setup lang="ts">
import Website from "@layouts/website.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import ContactInformation from "@pages/website/sections/contact-information.vue";
import ContactForm from "@pages/website/sections/contact-form.vue";
</script>
<template>
    <Website
        :page-title="getTrans('contact.page_title')"
        :page-sub-title="getTrans('contact.page_sub_title')"
        :meta-title="getTrans('contact.meta_title')">
        <div id="page-website-contact">
            <div class="grid container">
                <contact-information></contact-information>
                <contact-form></contact-form>
            </div>
        </div>
    </Website>
</template>
<style scoped>
@import "@css/pages/website/contact.css";
</style>
