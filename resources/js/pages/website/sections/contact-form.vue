<script setup lang="ts">

import {useForm} from "@inertiajs/vue3";
import InputComponent from "@components/forms/input-component.vue";
import TextareaComponent from "@components/forms/textarea-component.vue";
import ButtonComponent from "@components/button-component.vue";
import SubmitContactFormController from "@actions/App/Http/Controllers/SubmitContactFormController";
import {showToast} from "@composables/UseToastComposable";

const contactForm = useForm< {
    name: string;
    email: string;
    message: string;
}>({
        name: '',
        email: '',
        message: '',
});

const submitContactForm = () => {
    if (contactForm.processing) {
        return;
    }
    contactForm.submit(SubmitContactFormController(), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            contactForm.reset();
            showToast('Bericht werd succesvol verzonden!')
        }
    });
}

</script>
<template>
    <section class="section-website-contact-form">
        <form @submit.prevent="submitContactForm">
            <input-component
                v-model="contactForm.name"
                label="Name"
                type="text"
                name="name"
                placeholder="Name"
                :required="true"
                :error="contactForm.errors.name"
            ></input-component>
            <input-component
                v-model="contactForm.email"
                label="Email"
                type="email"
                name="email"
                placeholder="Email"
                :required="true"
                :error="contactForm.errors.email"
            ></input-component>
            <textarea-component
                v-model="contactForm.message"
                label="Message"
                name="message"
                placeholder="Message"
                :error="contactForm.errors.message"
                :required="true"
            ></textarea-component>
            <button-component
                :disabled="contactForm.processing"
                text="Verstuur"
                @click="submitContactForm"
            ></button-component>
        </form>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/contact-form.css";
</style>
