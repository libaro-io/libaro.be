<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {ClientInterface} from "@interfaces/ClientInterface";
import ClientRandomProjectController from "@actions/App/Http/Controllers/ClientRandomProjectController";
import {useS3Image} from "@composables/useS3Image";
import {computed} from "vue";

const props = defineProps<{
    client: ClientInterface;
}>();

const image = computed(() => {
    return props.client.image ? useS3Image(props.client.image) : null;
});
</script>
<template>
    <section class="component-client-block-component">
        <Link prefetch :href="ClientRandomProjectController({client:props.client})">
            <img v-if="image" :src="image" :alt="props.client.name"/>
        </Link>
    </section>
</template>
<style scoped>
@import "@css/components/client-block-component.css";
</style>
