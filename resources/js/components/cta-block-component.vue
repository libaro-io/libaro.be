<script setup lang="ts">

import SubTitleComponent from "@components/sub-title-component.vue";

const props = defineProps<{
    title: string,
    subtitle?: string,
    description?: string,
    backgroundImage?: string,
}>();

</script>
<template>
    <section class="component-cta-block-component">
       <div
           class="inner-container">
           <img
               v-if="props.backgroundImage"
               :src="props.backgroundImage"
               :alt="props.title"
               loading="lazy"
           >
           <div class="gradient"></div>
           <div class="inner">
               <div class="titles">
                   <h2>{{ props.title }}</h2>
                   <sub-title-component
                       :has-margin="false"
                   >
                       <h3>{{ props.subtitle }}</h3>
                   </sub-title-component>
               </div>

               <p v-if="props.description">{{ props.description }}</p>
           </div>
       </div>
    </section>
</template>
<style scoped>
@import "@css/components/cta-block-component.css";
</style>
