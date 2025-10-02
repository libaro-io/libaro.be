import './bootstrap';
import '../css/app.css';
import "vue3-toastify/dist/index.css";
import {createApp, DefineComponent, h} from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import {i18nVue} from "laravel-vue-i18n";
import {VueReCaptcha} from "vue-recaptcha-v3";
import PageInterface from "@interfaces/PageInterface";
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers";

// Language files get loaded eagerly.
const langs: Record<
    string,
    {
        default: {
            [key: string]: string;
        };
    }
> = import.meta.glob("../../lang/*.json", {
    eager: true,
});
const langResolver: (lang: string) => { [key: string]: string } | undefined = (
    lang: string,
) => langs[`../../lang/${lang}.json`].default;

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),

    setup({ el, App, props, plugin }) {
        const pageProps = props.initialPage.props as unknown as PageInterface;
        const captcheKey = pageProps.pageProps.recaptcha_site_key as string;
         createApp({ render: () => h(App, props) })
            .use(i18nVue, {
                resolve: langResolver,
            })
            .use(VueReCaptcha, {
                siteKey: captcheKey,
                loaderOptions: {}
            })
            .use(plugin)
            .mount(el)
    },
})
