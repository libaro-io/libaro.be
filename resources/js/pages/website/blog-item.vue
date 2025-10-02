<script setup lang="ts">
import {BlogInterface} from "@interfaces/BlogInterface";
import ContentBlock from "@pages/website/sections/content-block.vue";
import Website from "@layouts/website.vue";
import ButtonComponent from "@components/button-component.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import BlogItemLink from "@pages/website/sections/blog-item-link.vue";
import {computed} from "vue";
import {useS3Image} from "@composables/useS3Image";

const props = defineProps<{
    blog: BlogInterface
}>()

const hero = computed(() => {
    return props.blog.image ? useS3Image(props.blog.image) : null
})
</script>
<template>
    <website
        :page-title="props.blog.title"
        :page-sub-title="props.blog.author"
        :page-description="blog.date"
        :header-options="{
            fullWidthDescription: true,
            tags: props.blog.tags,
            background: hero
        }"
        :meta-title="props.blog.title"
        :marginBottom="false">
        <div id="page-website-blog-item">
            <content-block
                v-for="(block, index) in props.blog.blocks" :key="index"
                :alt="props.blog.title"
                :block="block"/>

            <blog-item-link v-if="props.blog.link">
                <a :href="props.blog.link" target="_blank">
                    <button-component
                        :text="getTrans('blog.read_more')"
                        color="tertiary"
                        size="large"
                        icon="fa-solid fa-chevron-right"
                    ></button-component>
                </a>
            </blog-item-link>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/blog-item.css";
</style>
