<script setup lang="ts">

import {useForm} from "@inertiajs/vue3";
import InputComponent from "@components/forms/input-component.vue";
import TextareaComponent from "@components/forms/textarea-component.vue";
import ButtonComponent from "@components/button-component.vue";
import SubmitContactFormController from "@actions/App/Http/Controllers/SubmitContactFormController";
import { getTrans } from "@composables/UseTranslationHelper";
import {showToast} from "@composables/UseToastComposable";
import {onMounted, ref} from "vue";
import {usePage} from "@inertiajs/vue3";

// Extend Window interface for reCAPTCHA
declare global {
    interface Window {
        grecaptcha: {
            ready: (callback: () => void) => void;
            execute: (siteKey: string, options: { action: string }) => Promise<string>;
        };
    }
}

interface PageProps {
    recaptcha_site_key?: string;
}

const recaptchaLoaded = ref(false);
const page = usePage<{ pageProps?: PageProps }>();

// Load reCAPTCHA script dynamically
const loadRecaptcha = (siteKey: string): Promise<void> => {
    return new Promise((resolve, reject): void => {
        if (window.grecaptcha) {
            recaptchaLoaded.value = true;
            resolve();
            return;
        }

        const script = document.createElement('script');
        script.src = `https://www.google.com/recaptcha/api.js?render=${siteKey}`;
        script.async = true;
        script.defer = true;
        script.onload = (): void => {
            window.grecaptcha.ready((): void => {
                recaptchaLoaded.value = true;
                resolve();
            });
        };
        script.onerror = reject;
        document.head.appendChild(script);
    });
};

onMounted(async (): Promise<void> => {
    const recaptchaSiteKey = page.props.pageProps?.recaptcha_site_key;
    if (!recaptchaSiteKey) {
        return;
    }

    try {
        await loadRecaptcha(recaptchaSiteKey);
    } catch {
        // Failed to load reCAPTCHA - silently fail
    }
});

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

const submitContactForm = async (): Promise<void> => {
    if (contactForm.processing) {
        return;
    }

    if (!recaptchaLoaded.value) {
        return;
    }

    try {
        const recaptchaSiteKey = page.props.pageProps?.recaptcha_site_key;
        if (!recaptchaSiteKey) {
            return;
        }
        contactForm.captcha_token = await window.grecaptcha.execute(recaptchaSiteKey, { action: 'submit' });
    } catch {
        return;
    }

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
            <p class="recaptcha" v-html="getTrans('contact.form.recaptcha')"></p>
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
