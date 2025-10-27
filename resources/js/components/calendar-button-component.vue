<script setup lang="ts">
import ButtonComponent from "@components/button-component.vue";
import {getTrans} from "@composables/UseTranslationHelper";
</script>

<template>
    <a href="https://libaro.odoo.com/book/meeting" target="_blank" rel="nofollow noopener">
        <button-component
            :text="getTrans('contact.calendar')"
            color="tertiary"
            size="small"
        />
    </a>
</template>

