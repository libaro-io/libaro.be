<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {ClientInterface} from "@interfaces/ClientInterface";
import ClientRandomProjectController from "@actions/App/Http/Controllers/ClientRandomProjectController";
import {useS3Image} from "@composables/useS3Image";

const props = defineProps<{
    client: ClientInterface;
}>();

</script>
<template>
    <section class="component-client-block-component">
        <Link prefetch :href="ClientRandomProjectController({client:props.client})">
            <img :src="useS3Image(props.client.image)" :alt="props.client.name" />
        </Link>
    </section>
</template>
<style scoped>
@import "@css/components/client-block-component.css";
</style>
