<script setup lang="ts">
import {UspListInterface} from "@interfaces/UspListInterface";
import {getTrans} from "@composables/UseTranslationHelper";

const props = defineProps<{
    uspList: UspListInterface;
    coloredBackground?: boolean;
}>();

</script>
<template>
    <section class="component-usp-list-component"
             :class="{'colored-background': props.coloredBackground}">
        <div class="container">
            <header>
                <h2
                    v-if="props.uspList.title"
                >
                    {{ getTrans(props.uspList.title) }}
                </h2>
                <p
                    v-if="props.uspList.description"
                >
                    {{ getTrans(props.uspList.description) }}
                </p>
            </header>
            <div class="items">
                <div
                    :key="index"
                    v-for="(item, index) in props.uspList.listItems"
                >
                    <h3>{{ getTrans(item.title) }}</h3>
                    <p>{{ getTrans(item.description) }}</p>
                </div>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/usp-list-component.css";
</style>
