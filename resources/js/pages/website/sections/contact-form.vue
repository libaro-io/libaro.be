<script setup lang="ts">

import {useForm} from "@inertiajs/vue3";
import InputComponent from "@components/forms/input-component.vue";
import TextareaComponent from "@components/forms/textarea-component.vue";
import ButtonComponent from "@components/button-component.vue";
import SubmitContactFormController from "@actions/App/Http/Controllers/SubmitContactFormController";
import { getTrans } from "@composables/UseTranslationHelper";
import {showToast} from "@composables/UseToastComposable";
import {useReCaptcha} from "vue-recaptcha-v3";

const recaptcha = useReCaptcha()
const contactForm = useForm< {
    name: string;
    email: string;
    message: string;
    captcha_token: string;
}>({
        name: '',
        email: '',
        message: '',
        captcha_token: '',
});

const submitContactForm = async () => {
    if (contactForm.processing) {
        return;
    }
    console.log('submitContactForm')
    if (!recaptcha) {
        console.error('ReCaptcha is not available');
        return;
    }
    await recaptcha.recaptchaLoaded();
    contactForm.captcha_token = await recaptcha.executeRecaptcha('submit');
    console.log(contactForm.captcha_token)
    contactForm.submit(SubmitContactFormController(), {
        preserveScroll: true,
        preserveState: 'errors',
        onSuccess: () => {
            contactForm.reset();
            showToast(getTrans('contact.form.success'))
        }
    });
}

</script>
<template>
    <section class="section-website-contact-form">
        <form @submit.prevent="submitContactForm">
            <input-component
                v-model="contactForm.name"
                :label="getTrans('contact.form.name.label')"
                type="text"
                name="name"
                :placeholder="getTrans('contact.form.name.placeholder')"
                :required="true"
                :error="contactForm.errors.name"
            ></input-component>
            <input-component
                v-model="contactForm.email"
                :label="getTrans('contact.form.email.label')"
                type="email"
                name="email"
                :placeholder="getTrans('contact.form.email.placeholder')"
                :required="true"
                :error="contactForm.errors.email"
            ></input-component>
            <textarea-component
                v-model="contactForm.message"
                :label="getTrans('contact.form.message.label')"
                name="message"
                :placeholder="getTrans('contact.form.message.placeholder')"
                :required="true"
                :error="contactForm.errors.message"
            ></textarea-component>
            <div class="button">
                <button-component
                    :disabled="contactForm.processing"
                    :text="getTrans('contact.form.submit')"
                ></button-component>
            </div>
        </form>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/contact-form.css";
</style>
