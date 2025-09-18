<script setup lang="ts">
import {DateTime} from "luxon";
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
import PageInterface from "@interfaces/PageInterface";
import {getTrans} from "@composables/UseTranslationHelper";

const page = usePage<PageInterface>();

const getCopyrightYear = computed(():string => {
    return '© ' + DateTime.now().year.toString();
});

</script>
<template>
    <footer class="section-footer">
       <div class="inner-container container">
           <div class="section">
                  <h2 class="footer-title">{{ getCopyrightYear }}</h2>
                  <p>{{ getTrans('footer.description') }}</p>
           </div>
           <div class="section">
               <h2 class="footer-title">{{ getTrans('footer.contact') }}</h2>
               <div class="bert">
                   <div class="outer-image-bert">
                       <div class="image-bert">
                           <img src="@assets/images/bert.jpg" alt="bert">
                       </div>
                   </div>
                   <div class="bert-info">
                       <p> {{ page.props.pageProps.company.email }} </p>
                       <p> {{ page.props.pageProps.company.phone }} </p>
                   </div>
               </div>
               <address>
                   <p> {{ page.props.pageProps.company.address.street }} {{ page.props.pageProps.company.address.number }} </p>
                   <p> {{ page.props.pageProps.company.address.zip }} {{ page.props.pageProps.company.address.city }} </p>
               </address>
           </div>
           <div class="section">
               <h2 class="footer-title">{{ getTrans('footer.financial') }}</h2>
               <p> {{ page.props.pageProps.company.btw }} </p>
               <p> {{ page.props.pageProps.company.accountNumber }} </p>
           </div>
           <div class="section">
               <h2 class="footer-title">{{ getTrans('footer.privacy') }}</h2>
           </div>
           <div class="section">
                   <h2 class="footer-title">{{getTrans('footer.follow_us')}}</h2>
               <div class="social-media">
                   <a target="_blank" :href="page.props.pageProps.socials.facebook">
                       <span class="icon facebook">
                           <i class="fa-brands fa-facebook-f"></i>
                       </span>
                   </a>
                   <a target="_blank" :href="page.props.pageProps.socials.linkedin">
                       <span class="icon linkedin">
                           <i class="fa-brands fa-linkedin-in"></i>
                       </span>
                   </a>
                   <a target="_blank" :href="page.props.pageProps.socials.mail">
                       <span class="icon email">
                           <i class="fa-regular fa-paper-plane"></i>
                       </span>
                   </a>
                   <a target="_blank" :href="page.props.pageProps.socials.github">
                       <span class="icon github">
                           <i class="fa-brands fa-github"></i>
                       </span>
                   </a>
               </div>
           </div>
           <div class="section">
               <h2 class="footer-title">{{ getTrans('footer.assets') }}</h2>
           </div>
       </div>
    </footer>
</template>
<style scoped>
@import "@css/layouts/sections/footer.css";
</style>
