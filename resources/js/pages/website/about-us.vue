<script setup lang="ts">
import Website from "@layouts/website.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import TextBlockImageComponent from "@components/text-block-image-component.vue";
import {TextBlockImageInterface} from "@interfaces/TextBlockImageInterface";
import aboutImage1 from "@assets/images/team_4_584.webp";
import aboutImage2 from "@assets/images/team_584.webp";
import aboutImage3 from "@assets/images/team_10_584.webp";
import aboutImage4 from "@assets/images/team_3_584.webp";
import aboutImage5 from "@assets/images/team_5_1046.webp";
import aboutImage6 from "@assets/images/team_2_1046.webp";
import aboutImage7 from "@assets/images/team_6_1046.webp";
import aboutImage8 from "@assets/images/team_7_1046.webp";
import aboutImage9 from "@assets/images/team_8_1046.webp";
import aboutImage10 from "@assets/images/team_9_1046.webp";
import LargeImageComponent from "@components/large-image-component.vue";
import CtaContact from "@pages/website/sections/cta-contact.vue";
import {computed} from "vue";

const textBlockImageComponents = computed<TextBlockImageInterface[]>(() => [
    {
        subTitle: getTrans('about.block_1.sub_title'),
        title: getTrans('about.block_1.title'),
        texts: [getTrans('about.block_1.texts.0'), getTrans('about.block_1.texts.1')],
        image: aboutImage1,
    },
    {
        subTitle: getTrans('about.block_2.sub_title'),
        title: getTrans('about.block_2.title'),
        texts: [getTrans('about.block_2.texts.0')],
        image: aboutImage2,
    },
    {
        subTitle: getTrans('about.block_3.sub_title'),
        title: getTrans('about.block_3.title'),
        texts: [getTrans('about.block_3.texts.0'), getTrans('about.block_3.texts.1')],
        image: aboutImage3,
    },
    {
        subTitle: getTrans('about.block_4.sub_title'),
        title: getTrans('about.block_4.title'),
        texts: [getTrans('about.block_4.texts.0'), getTrans('about.block_4.texts.1')],
        image: aboutImage4,
    }
]);

const largeImageComponents: string[] = [
    aboutImage5,
    aboutImage6,
    aboutImage7,
    aboutImage8,
    aboutImage9,
    aboutImage10,
    ];

</script>
<template>
    <website
        :page-title="getTrans('about.page_title')"
        :page-description="getTrans('about.description')"
        :header-options="{
            fullWidthDescription: true,
        }"
        meta-key="about_us">
        <div id="page-website-about-us">
            <div class="container page-grid">
                <text-block-image-component
                    v-for="(textBlockImage, index) in textBlockImageComponents"
                    :key="index"
                    :text-block-image="textBlockImage"
                    :image-side="index % 2 === 0 ? 'right' : 'left'"
                    :fetch-priority="index === 0 ? 'high' : 'auto'"
                ></text-block-image-component>
                <div class="large-images">
                    <large-image-component
                        v-for="(largeImage, index) in largeImageComponents" :key="index"
                        :image="largeImage"
                    ></large-image-component>
                </div>
            </div>
            <cta-contact></cta-contact>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/about-us.css";
</style>
