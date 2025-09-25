<script setup lang="ts">
import CtaBlockComponent from "@components/cta-block-component.vue";
import {Link} from "@inertiajs/vue3";
import ProjectController from "@actions/App/Http/Controllers/ProjectController";
</script>
<template>
    <section class="section-website-our-projects">
        <div class="container">
            <div class="inner-container ">
                <Link :href="ProjectController({})">
                    <cta-block-component
                        title="Zoute Grand Prix"
                        subtitle="Webapplicatie"
                        description="test description"
                    ></cta-block-component>
                </Link>
                <Link>
                    <cta-block-component
                        title="Zoute Grand Prix"
                        subtitle="Webapplicatie"
                        description="test description"
                    ></cta-block-component>
                </Link>
                <Link>
                    <cta-block-component
                        title="Zoute Grand Prix"
                        subtitle="Webapplicatie"
                        description="test description"
                    ></cta-block-component>
                </Link>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/our-projects.css";
</style>
