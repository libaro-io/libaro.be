<script setup lang="ts">
import libaroIcon from "@assets/logos/libaro_icon.png";
import libaroBlueWithoutTagline from "@assets/logos/libaro_logo_full_blue_without_tagline.svg";
import libaroBlue from "@assets/logos/libaro_logo_full_blue.svg";
import ButtonComponent from "@components/button-component.vue";
import {getTrans} from "@composables/UseTranslationHelper";

interface AssetsInterface {
    name: string;
    image: string;
}

const assets: AssetsInterface[] = [
    {
        name: getTrans('sections.assets.asset_names.libaro_icon'),
        image: libaroIcon,
    },
    {
        name: getTrans('sections.assets.asset_names.libaro_blue'),
        image: libaroBlue,
    },
    {
        name: getTrans('sections.assets.asset_names.libaro_blue_without_tagline'),
        image: libaroBlueWithoutTagline,
    }
];

const downloadAsset = async (imageUrl: string, name: string): Promise<void> => {
    try {
        const response = await fetch(imageUrl);
        const blob = await response.blob();
        const blobUrl = window.URL.createObjectURL(blob);

        if (typeof document !== 'undefined') {
            const link = document.createElement('a');
            link.href = blobUrl;
            const extension = imageUrl.split('.').pop()?.split('?')[0] || 'png';
            link.download = `libaro-${name.toLowerCase().replace(/\s+/g, '-')}.${extension}`;
            document.body.appendChild(link);
            link.click();
            setTimeout(() => {
                document.body.removeChild(link);
                window.URL.revokeObjectURL(blobUrl);
            }, 100);
        }
    } catch (error) {
        alert(error);
    }
}

</script>
<template>
    <section class="section-website-assets container">
        <div
            v-for="asset in assets"
            :key="asset.name"
            class="logo">
            <img :src="asset.image" :alt="asset.name">
            <button-component
                @click="downloadAsset(asset.image, asset.name)"
                :text="getTrans('sections.assets.download_button')"
                class="download-button"></button-component>
        </div>
    </section>
</template>
<style scoped>
@import "@css/pages/website/sections/assets.css";
</style>
