<script setup lang="ts">
import { getTrans } from "@composables/UseTranslationHelper";
import Website from "@layouts/website.vue";
import LegalHeroComponent from "@components/legal-hero-component.vue";
import CtaContact from "@pages/website/sections/cta-contact.vue";

const sections = [
    {
        icon: "fa-solid fa-calculator",
        heading: "sla.post_calculation.heading",
        paragraphs: [
            "sla.post_calculation.paragraph_1",
            "sla.post_calculation.paragraph_2",
        ],
    },
    {
        icon: "fa-solid fa-bullseye",
        heading: "sla.scope.heading",
        paragraphs: ["sla.scope.paragraph_1", "sla.scope.paragraph_2"],
    },
    {
        icon: "fa-solid fa-comments",
        heading: "sla.consultation.heading",
        paragraphs: [
            "sla.consultation.paragraph_1",
            "sla.consultation.paragraph_2",
        ],
    },
    {
        icon: "fa-solid fa-eye",
        heading: "sla.transparency.heading",
        paragraphs: [
            "sla.transparency.paragraph_1",
            "sla.transparency.paragraph_2",
        ],
    },
    {
        icon: "fa-solid fa-pen-to-square",
        heading: "sla.communication.heading",
        paragraphs: [
            "sla.communication.paragraph_1",
            "sla.communication.paragraph_2",
        ],
    },
    {
        icon: "fa-solid fa-bolt",
        heading: "sla.response_time.heading",
        paragraphs: [
            "sla.response_time.paragraph_1",
            "sla.response_time.paragraph_2",
        ],
    },
    {
        icon: "fa-solid fa-rocket",
        heading: "sla.delivery.heading",
        paragraphs: ["sla.delivery.paragraph_1", "sla.delivery.paragraph_2"],
    },
] as const;
</script>
<template>
    <website
        :page-title="getTrans('sla.page_title')"
        meta-key="sla"
        :marginBottom="false"
    >
        <div id="page-website-sla">
            <legal-hero-component
                eyebrow="SLA"
                :title="getTrans('sla.intro.heading')"
                :lead="getTrans('sla.intro.paragraph_1')"
            ></legal-hero-component>

            <section class="sla-sections">
                <div class="container">
                    <div class="sections-grid">
                        <article
                            v-for="(section, index) in sections"
                            :key="section.heading"
                            class="sla-card"
                        >
                            <span
                                class="card-number"
                                v-text="String(index + 1).padStart(2, '0')"
                            ></span>

                            <div class="card-icon">
                                <i :class="section.icon"></i>
                            </div>

                            <h2 v-text="getTrans(section.heading)"></h2>

                            <div class="card-body">
                                <p
                                    v-for="paragraph in section.paragraphs"
                                    :key="paragraph"
                                    v-text="getTrans(paragraph)"
                                ></p>
                            </div>
                        </article>
                    </div>
                </div>
            </section>

            <cta-contact
                title="sla.cta.heading"
            ></cta-contact>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/sla.css";
</style>
