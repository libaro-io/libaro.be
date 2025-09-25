<script setup lang="ts">
import {BlogInterface} from "@interfaces/BlogInterface";
import ContentBlock from "@pages/website/sections/content-block.vue";
import Website from "@layouts/website.vue";
import ButtonComponent from "@components/button-component.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import {Link, router} from "@inertiajs/vue3";
import BlogItemLink from "@pages/website/sections/blog-item-link.vue";

const props = defineProps<{
    blog: BlogInterface
}>()
</script>
<template>
    <website
        :page-title="props.blog.title"
        :page-sub-title="props.blog.author"
        :page-description="blog.date"
        :header-options="{
            fullWidthDescription: true,
            tags: props.blog.tags,
        }"
        :meta-title="props.blog.title"
        :marginBottom="false">
        <div id="page-website-blog-item">
            <content-block
                v-for="(block, index) in props.blog.blocks" :key="index"
                :alt="props.blog.title"
                :block="block"/>

            <blog-item-link v-if="props.blog.link">
                <button-component
                    @click="router.visit(props.blog.link)"
                    :text="getTrans('blog.read_more')"
                    color="tertiary"
                    size="large"
                    icon="fa-solid fa-chevron-right"
                ></button-component>
            </blog-item-link>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/blog-item.css";
</style>
