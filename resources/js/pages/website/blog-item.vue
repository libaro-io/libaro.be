<script setup lang="ts">
import {BlogInterface} from "@interfaces/BlogInterface";
import ContentBlock from "@pages/website/sections/content-block.vue";
import Website from "@layouts/website.vue";
import ButtonComponent from "@components/button-component.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import {computed} from "vue";
import {useS3Image} from "@composables/useS3Image";
import LargeImageSubtitleComponent from "@components/large-image-subtitle-component.vue";

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
            whiteVariant: true,
            tags: props.blog.tags,
            fullWidthDescription: true
        }"
        meta-key="blogs"
        :meta-title-override="props.blog.title"
        :meta-description-override="props.blog.description"
        :marginBottom="false">
        <div id="page-website-blog-item">
            <content-block
                v-for="(block, index) in props.blog.blocks" :key="index"
                :alt="props.blog.title"
                :block="block"/>

            <large-image-subtitle-component
                class="mt-10"
                :image="hero"
                :contain-image="true"
                align="center"
            >
                <a
                    v-if="props.blog.link"
                    :href="props.blog.link"
                    target="_blank">
                    <button-component
                        :text="getTrans('blog.read_more')"
                        color="tertiary"
                        size="large"
                        icon="fa-solid fa-chevron-right"
                    ></button-component>
                </a>
            </large-image-subtitle-component>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/blog-item.css";
</style>
