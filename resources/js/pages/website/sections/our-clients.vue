<script setup lang="ts">
import SubTitleComponent from "@components/sub-title-component.vue";
import TitleComponent from "@components/title-component.vue";
import {PaginationInterface} from "@interfaces/PaginationInterface";
import {usePagination} from "@composables/UsePaginationComposable";
import ClientBlockComponent from "@components/client-block-component.vue";
import {ClientInterface} from "@interfaces/ClientInterface";
import {computed} from "vue";

const props = defineProps<{
    clients?: PaginationInterface<ClientInterface[]> | ClientInterface[];
}>();

const isPaginated = computed(() => {
    return props.clients && 'data' in props.clients;
});

const clientList = computed<ClientInterface[]>(() => {
    if (!props.clients) {
        return [];
    }
    return isPaginated.value
        ? (props.clients as PaginationInterface<ClientInterface[]>).data
        : props.clients as ClientInterface[];
});

const {
    goToNextPage,
    goToPreviousPage,
    canGoToNextPage,
    canGoToPreviousPage,
} = usePagination<ClientInterface>(
    () => isPaginated.value ? props.clients as PaginationInterface<ClientInterface[]> : undefined,
    ['clients']
);
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
                <div v-if="isPaginated" class="buttons">
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
                v-if="clientList.length"
                class="client-wrapper">
                <client-block-component
                    v-for="client in clientList" :key="client.name"
                    :client="client"
                ></client-block-component>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/our-clients.css";
</style>
