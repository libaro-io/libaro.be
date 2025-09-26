<script setup lang="ts">
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";

const props = defineProps<{
    listWithImage: ListWithImageInterface
}>();

</script>
<template>
    <section class="component-list-with-image-component">
        <header>
            <h2> {{ listWithImage.title }} </h2>
            <p v-for="description in listWithImage.descriptions">
                {{ description }}
            </p>
        </header>
        <div class="list-image">
            <ul>
                <li v-for="listItem in listWithImage.listItems">
                    <h3>{{listItem.title}}</h3>
                    <p>{{listItem.description}}</p>
                </li>
            </ul>
            <div class="image-container">
                <img src="https://placehold.co/600x400" alt="">
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/list-with-image-component.css";
</style>
