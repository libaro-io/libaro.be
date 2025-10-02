<script setup lang="ts">
import CtaBlockComponent from "@components/cta-block-component.vue";
import {LandingPageInterface} from "@interfaces/LandingPageInterface";
import {Link} from "@inertiajs/vue3";
import LandingPageController from "@actions/App/Http/Controllers/LandingPageController";
import {getTrans} from "@composables/UseTranslationHelper";
import {getLandingPageImage} from "@composables/UseLandingPageImage";
import TitleComponent from "@components/title-component.vue";

const props = defineProps<{
    landingPages: LandingPageInterface[]
}>()
</script>
<template>
    <section class="section-website-interesting-for-you">
        <div class="container">
            <header>
                <title-component>
                    <h3>{{ getTrans('projects.interesting_for_you') }}</h3>
                </title-component>
            </header>

            <div class="inner-container">
                <Link
                    v-for="landingPage in props.landingPages"
                    :key="landingPage.slug"
                    :href="LandingPageController({landingPage: { slug: landingPage.slug } })">
                    <cta-block-component
                        :title="landingPage.title"
                        :subtitle="landingPage.skill"
                        :background-image="getLandingPageImage(landingPage.block?.image_index)"
                    ></cta-block-component>
                </Link>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/interesting-for-you.css";
</style>
