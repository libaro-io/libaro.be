<script setup lang="ts">
import {getTrans} from "@composables/UseTranslationHelper";
import Website from "@layouts/website.vue";
import {BlogInterface} from "@interfaces/BlogInterface";
import CardListComponent from "@components/card-list-component.vue";
import CardComponent from "@components/card-component.vue";
import DetailBlogController from "@actions/App/Http/Controllers/DetailBlogController";
import {useS3Image} from "@composables/useS3Image";

const props = defineProps<{
    blogs: BlogInterface[]
}>();
</script>
<template>
    <website
        :page-title="getTrans('blogs.page_title')"
        :page-description="getTrans('blogs.page_description')"
        :meta-title="getTrans('blogs.meta_title')"
        :marginBottom="false">
        <div id="page-website-blog">
            <card-list-component>
                <card-component
                    v-for="(blog, index) in props.blogs" :key="index"
                    :link="DetailBlogController({blog: blog.slug}).url"
                    :image="useS3Image(blog.image)"
                    :title="blog.title"
                    :tags="blog.tags"
                ></card-component>
            </card-list-component>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/blog.css";
</style>
