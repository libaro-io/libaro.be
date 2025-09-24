<script setup lang="ts">
import Website from "@layouts/website.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import ContactInformation from "@pages/website/sections/contact-information.vue";
import ContactForm from "@pages/website/sections/contact-form.vue";
import LargeImageSubtitleComponent from "@components/large-image-subtitle-component.vue";
import strategy2 from "@assets/images/strategy_2.webp";
</script>
<template>
    <Website
        :page-title="getTrans('contact.page_title')"
        :page-sub-title="getTrans('contact.page_sub_title')"
        :meta-title="getTrans('contact.meta_title')">
        <div id="page-website-contact">
            <div class="grid container">
                <div>
                    <contact-information></contact-information>
                </div>
                <contact-form></contact-form>
            </div>

            <large-image-subtitle-component
                :image="strategy2"
                :subtitle="getTrans('contact.meet_us')"
            ></large-image-subtitle-component>
        </div>
    </Website>
</template>
<style scoped>
@import "@css/pages/website/contact.css";
</style>
