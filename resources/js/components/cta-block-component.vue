<script setup lang="ts">

import SubTitleComponent from "@components/sub-title-component.vue";

const props = withDefaults(defineProps<{
    title: string,
    subtitle?: string,
    description?: string,
    backgroundImage?: string,
}>(),{
    backgroundImage: 'https://placecats.com/millie/300/150'
})

</script>
<template>
    <section class="component-cta-block-component">
       <div
           :style="{ backgroundImage: 'url(' + backgroundImage + ')' }"
           class="inner-container">
           <div class="gradient"></div>
           <div class="inner">
               <sub-title-component
                   :has-margin="false"
               >
                   <h3>{{ props.subtitle }}</h3>
               </sub-title-component>
               <h2>{{ props.title }}</h2>
               <p v-if="props.description">{{ props.description }}</p>
           </div>
       </div>
    </section>
</template>
<style scoped>
@import "@css/components/cta-block-component.css";
</style>
