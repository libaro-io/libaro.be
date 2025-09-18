<script setup lang="ts">
import {DateTime} from "luxon";
import {computed} from "vue";
import {Link, usePage} from "@inertiajs/vue3";
import PageInterface from "@interfaces/PageInterface";
import {getTrans} from "@composables/UseTranslationHelper";
import HomeController from "../../actions/App/Http/Controllers/HomeController";

const page = usePage<PageInterface>();

const getCopyrightYear = computed(():string => {
    return '© ' + DateTime.now().year.toString();
});

const footerPrivacyUrls: {title:string; url: {url: string, method: 'get'} }[] = [
    {
        title: getTrans('footer.privacy_policy'),
        url: HomeController(),
    },
    {
        title: getTrans('footer.cookie_policy'),
        url: HomeController(),
    },
    {
        title: getTrans('footer.terms_and_conditions'),
        url: HomeController(),
    }
];

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
                       <a :href="'mailto:'+ page.props.pageProps.company.email"> {{ page.props.pageProps.company.email }} </a>
                       <a :href="'tel:'+ page.props.pageProps.company.phone"> {{ page.props.pageProps.company.phone }} </a>
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
               <ul>
                   <li v-for="url in footerPrivacyUrls" :key="url.title">
                       <Link :href="url.url"> {{ url.title }} </Link>
                   </li>
               </ul>
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
               <Link :href="HomeController()"> {{ getTrans('urls.branding') }} </Link>
           </div>
       </div>
    </footer>
</template>
<style scoped>
@import "@css/layouts/sections/footer.css";
</style>
