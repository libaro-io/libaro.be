<script setup lang="ts">
import {getTrans} from "@composables/UseTranslationHelper";
import Website from "@layouts/website.vue";
import CardListComponent from "@components/card-list-component.vue";
import CardComponent from "@components/card-component.vue";
import {ProjectInterface} from "@interfaces/ProjectInterface";
import DetailProductController from "@actions/App/Http/Controllers/DetailProductController";
import {useS3Image} from "@composables/useS3Image";

const props = defineProps<{
    products: ProjectInterface[]
}>()
</script>
<template>
    <website
        :page-title="getTrans('products.page_title')"
        :page-sub-title="getTrans('products.page_sub_title')"
        :page-description="getTrans('products.page_description')"
        meta-key="products"
        :marginBottom="false">
        <div id="page-website-products">
            <card-list-component>
                <card-component
                    v-for="(product, index) in props.products" :key="index"
                    :title="product.name"
                    :image="useS3Image(product.image)"
                    :link="DetailProductController({product: product.slug}).url"
                    :sub-title="product.client.name"
                    :category="product.type"
                ></card-component>
            </card-list-component>
        </div>
    </website>
    x
</template>
<style scoped>
@import "@css/pages/website/products.css";
</style>
