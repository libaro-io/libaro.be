<script setup lang="ts">
import Website from "@layouts/website.vue";
import ListWithImageComponent from "@components/list-with-image-component.vue";
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";

const conceptToWebApplicationBlock: ListWithImageInterface = {
    title: "Van concept tot webapplicatie",
    descriptions: [
        'Wij vertrekken niet vanuit de vraag wat er technisch mogelijk is, maar vanuit de specifieke noden van jouw bedrijf. Dat is de kern van een webapplicatie op maat. In plaats van je aan te passen aan de beperkingen van standaardsoftware, bouwen wij een oplossing die volledig is afgestemd op jouw processen.',
        'Bovendien hoef je niet vanaf nul te beginnen. We kunnen je bestaande tools en favoriete software naadloos koppelen aan de nieuwe webapplicatie. Zo creëren we één centraal en krachtig systeem dat werkt zoals jij dat wilt, en je workflow optimaliseert.'
    ],
    listItems: [
        {
            title: 'Strategie & Analyse',
            description: 'In deze cruciale fase duiken we diep in uw bedrijfsprocessen, doelen en de specifieke uitdagingen die de applicatie moet oplossen. Samen met u vertalen we uw wensen naar een heldere functionele blauwdruk en een technische roadmap. Het resultaat is een glashelder plan dat garandeert dat we de juiste oplossing voor uw unieke situatie bouwen.',
            image: 'https://placehold.co/600x400'
        },
        {
            title: 'UX/UI Design',
            description: 'Een applicatie moet niet alleen krachtig, maar ook intuïtief zijn. Onze ontwerpers focussen zich eerst op de User Experience (UX): de meest logische en efficiënte flow voor de gebruiker. Vervolgens gieten we die structuur in een visueel aantrekkelijke en gebruiksvriendelijke User Interface (UI). Via interactieve prototypes krijgt u al een concreet gevoel bij de applicatie, nog voor er één regel code is geschreven.',
            image: 'https://placehold.co/600x400'
        },
        {
            title: 'Ontwikkeling & Testing',
            description: 'Onze ontwikkelaars zetten de blauwdruk om in robuuste en schone code, waarbij we bouwen aan een schaalbare en veilige applicatie. Gedurende het volledige ontwikkelproces wordt de applicatie continu en grondig getest op verschillende apparaten en browsers. Zo garanderen we een feilloze werking en optimale prestaties bij de uiteindelijke oplevering.',
            image: 'https://placehold.co/600x400'
        }
    ]
}

</script>
<template>

    <website>
        <div id="page-website-expertise-webdevelopment">
            <list-with-image-component
                :list-with-image="conceptToWebApplicationBlock"
                class="container"
            ></list-with-image-component>
        </div>
    </website>
</template>
<style scoped>
@import "@css/pages/website/expertise/webdevelopment.css";
</style>
