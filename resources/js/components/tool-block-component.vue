<script setup lang="ts">

import {ToolInterface} from "@interfaces/ToolInterface";
import {getTrans} from "@composables/UseTranslationHelper";
import IconComponent from "@components/icon-component.vue";

const props = defineProps<{
    tool: ToolInterface
}>();

</script>
<template>
    <section class="component-tool-block-component">
       <header>
           <icon-component
               :image="props.tool.image"
               :name="props.tool.name"
           ></icon-component>

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
