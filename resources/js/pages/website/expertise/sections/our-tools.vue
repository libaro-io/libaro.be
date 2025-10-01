<script setup lang="ts">
import {getTrans} from "@composables/UseTranslationHelper";
import TitleComponent from "@components/title-component.vue";
import {ToolInterface} from "@interfaces/ToolInterface";
import ToolBlockComponent from "@components/tool-block-component.vue";

const props = defineProps<{
    ourTools: ToolInterface[];
}>();

</script>
<template>
    <section class="section-website-expertise-our-tools">
       <div class="container">
           <header>
               <title-component
                   :has-margin="false"
               >
                   <h2>
                       {{ getTrans('sections.our_tools.title') }}
                   </h2>
               </title-component>

               <p>{{ getTrans('sections.our_tools.description') }}</p>
           </header>
           <div class="blocks">
               <tool-block-component
                   v-for="tool in props.ourTools"
                   :key="tool.name"
                   :tool="tool"
               ></tool-block-component>
           </div>
       </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/expertise/sections/our-tools.css";
</style>
