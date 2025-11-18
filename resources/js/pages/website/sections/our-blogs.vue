<script setup lang="ts">
import { getTrans } from "../../../composables/UseTranslationHelper";
import TitleComponent from "@components/title-component.vue";
import SubTitleComponent from "@components/sub-title-component.vue";
import DetailBlogController from "../../../actions/App/Http/Controllers/DetailBlogController";
import { BlogInterface } from "../../../interfaces/BlogInterface";
import { useS3Image } from "../../../composables/useS3Image";
import CardComponent from "@components/card-component.vue";
import BlogController from "../../../actions/App/Http/Controllers/BlogController";
import { Link } from "@inertiajs/vue3";
import ButtonComponent from "@components/button-component.vue";

const props = defineProps<{
    blogs: BlogInterface[];
}>();
</script>
<template>
    <section class="section-website-our-blogs">
        <div class="container">
            <div class="titles">
                <title-component :has-margin="false">
                    <h2>
                        {{ getTrans("sections.our-blogs.title") }}
                    </h2>
                </title-component>
                <sub-title-component :has-margin="false">
                    <h3>
                        {{ getTrans("sections.our-blogs.subtitle") }}
                    </h3>
                </sub-title-component>
            </div>

            <div class="inner-container-our-blogs">
                <card-component
                    v-for="(blog, index) in props.blogs"
                    :key="index"
                    :link="DetailBlogController({ blog: blog.slug }).url"
                    :image="useS3Image(blog.image)"
                    :title="blog.title"
                    :sub-title="blog.author"
                    :tags="blog.tags"
                ></card-component>
            </div>

            <div class="button">
                <Link prefetch :href="BlogController()">
                    <button-component
                        :text="getTrans('sections.our-blogs.button')"
                        color="tertiary"
                        size="large"
                        icon="fa-solid fa-chevron-right"
                    ></button-component>
                </Link>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/our-blogs.css";
</style>
