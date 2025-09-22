<script setup lang="ts">

import {useForm} from "@inertiajs/vue3";
import InputComponent from "@components/forms/input-component.vue";
import TextareaComponent from "@components/forms/textarea-component.vue";
import ButtonComponent from "@components/button-component.vue";

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
    console.log(contactForm)
}

</script>
<template>
    <section class="section-website-contact-form">
        <input-component
            v-model="contactForm.name"
            label="Name"
            type="text"
            name="name"
            placeholder="Name"
            :required="true"
        ></input-component>
        <input-component
            v-model="contactForm.email"
            label="Email"
            type="email"
            name="email"
            placeholder="Email"
            :required="true"
        ></input-component>
        <textarea-component
            v-model="contactForm.message"
            label="Message"
            name="message"
            placeholder="Message"
            :required="true"
        ></textarea-component>
        <button-component
            @click="submitContactForm"
        ></button-component>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/contact-form.css";
</style>
