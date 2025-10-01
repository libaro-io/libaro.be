<script setup lang="ts">

import {ToolInterface} from "@interfaces/ToolInterface";
import {getTrans} from "@composables/UseTranslationHelper";

const props = defineProps<{
    tool: ToolInterface
}>();

</script>
<template>
    <section class="component-tool-block-component">
       <header>
           <div class="image-container">
               <img :src="props.tool.image" :alt="props.tool.name">
           </div>
           <h3>{{ props.tool.name }}</h3>
       </header>
        <p>
            {{ getTrans(props.tool.description) }}
        </p>
    </section>
</template>
<style scoped>
@import "@css/components/tool-block-component.css";
</style>
