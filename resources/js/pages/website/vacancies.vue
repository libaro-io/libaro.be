<script setup lang="ts">
import {getTrans} from "@composables/UseTranslationHelper";
import {useS3Image} from "@composables/useS3Image";
import Website from "@layouts/website.vue";
import CardListComponent from "@components/card-list-component.vue";
import CardComponent from "@components/card-component.vue";
import {VacancyInterface} from "@interfaces/VacancyInterface";
import DetailVacancyController from "@actions/App/Http/Controllers/DetailVacancyController";

const props = defineProps<{
    vacancies: VacancyInterface[]
}>();
</script>
<template>
    <website
        :page-title="getTrans('vacancies.page_title')"
        :page-description="getTrans('vacancies.page_description')"
        meta-key="vacancies"
        :marginBottom="false"
        :header-options="{
            whiteVariant: true,
        }">
        <div id="page-website-vacancies">
            <card-list-component>
                <card-component
                    v-for="(vacancy, index) in props.vacancies" :key="index"
                    :link="DetailVacancyController({vacancy: vacancy.slug}).url"
                    :image="useS3Image(vacancy.image)"
                    :title="vacancy.title"
                ></card-component>
            </card-list-component>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/vacancies.css";
</style>
