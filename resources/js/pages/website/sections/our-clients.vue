<script setup lang="ts">
import SubTitleComponent from "@components/sub-title-component.vue";
import TitleComponent from "@components/title-component.vue";
import {PaginationInterface} from "@interfaces/PaginationInterface";
import {HomeClientInterface} from "@interfaces/HomeClientInterface";

const props = defineProps<{
    clients?: PaginationInterface<HomeClientInterface>;
}>();
</script>
<template>
    <section class="section-website-our-clients">
       <div class="content container">
            <div class="header">
                <div class="titles">
                    <sub-title-component>
                        <h3>Uw success is onze reputatie</h3>
                    </sub-title-component>
                    <title-component>
                        <h2>Onze klanten</h2>
                    </title-component>
                </div>
                <div class="buttons">
                    <button>Vorige</button>
                    <button>Volgende</button>
                </div>
            </div>
           {{props.clients}}
       </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/our-clients.css";
</style>
