<script setup lang="ts">
import {ProjectInterface} from "@interfaces/ProjectInterface";
import {useS3Image} from "@composables/useS3Image";
import {computed} from "vue";

const props = defineProps<{
    project: ProjectInterface
}>()

const image = computed(() => useS3Image(props.project.client.image) ?? null)
</script>
<template>
    <section class="section-website-project-intro">
        <div class="container">
            <div class="grid-layout">
                <div class="img-wrapper">
                    <img
                        v-if="image"
                        :src="image"
                        :alt="props.project.client.name"
                        class="logo"
                    />
                </div>
                <p class="text">
                    <strong
                        v-html="props.project.description"
                    ></strong>
                </p>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/project-intro.css";
</style>
