<script setup lang="ts">
import {DateTime} from "luxon";
import {computed} from "vue";

const getCopyrightYear = computed(():string => {
    return '© ' + DateTime.now().year.toString();
});

</script>
<template>
    <footer class="section-footer">
       <div class="inner-container container">
           <div class="section">
                  <h2 class="footer-title">{{ getCopyrightYear }}</h2>
                  <p>Libaro is een A-team van digital natives. We bouwen hoogstaande, digitale oplossingen, gebruikmakende van technische innovatie en artificiële intelligentie.</p>
           </div>
           <div class="section">
               <h2 class="footer-title">Onze contactgegevens</h2>
           </div>
           <div class="section">
               <h2 class="footer-title">Financieel</h2>
           </div>
           <div class="section">
               <h2 class="footer-title">Wij respecteren uw privacy</h2>
           </div>
           <div class="section">
                   <h2 class="footer-title">Volg ons</h2>
           </div>
           <div class="section">
               <h2 class="footer-title">Assets</h2>
           </div>
       </div>
    </footer>
</template>
<style scoped>
@import "@css/layouts/sections/footer.css";
</style>
