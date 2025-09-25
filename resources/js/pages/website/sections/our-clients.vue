<script setup lang="ts">
import SubTitleComponent from "@components/sub-title-component.vue";
import TitleComponent from "@components/title-component.vue";
import {PaginationInterface} from "@interfaces/PaginationInterface";
import {usePagination} from "@composables/UsePaginationComposable";
import ClientBlockComponent from "@components/client-block-component.vue";
import {ClientInterface} from "@interfaces/ClientInterface";

const props = defineProps<{
    clients?: PaginationInterface<ClientInterface[]>;
}>();

const {
    goToNextPage,
    goToPreviousPage,
    canGoToNextPage,
    canGoToPreviousPage,
} = usePagination<ClientInterface>(() => props.clients, ['clients']);
</script>
<template>
    <section class="section-website-our-clients">
        <div class="content container">
            <div class="header">
                <div class="titles">
                    <sub-title-component>
                        <h3>Uw success is onze reputatie</h3>
                    </sub-title-component>
                    <title-component :has-margin="false">
                        <h2>Onze klanten</h2>
                    </title-component>
                </div>
                <div class="buttons">
                    <button
                        :disabled="!canGoToPreviousPage"
                        @click="goToPreviousPage"
                    >
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button
                        :disabled="!canGoToNextPage"
                        @click="goToNextPage"
                    >
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div
                v-if="props.clients"
                class="client-wrapper">
                <client-block-component
                    v-for="client in props.clients.data" :key="client.name"
                    :client="client"
                ></client-block-component>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/our-clients.css";
</style>
