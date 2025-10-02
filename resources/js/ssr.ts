import {createInertiaApp} from '@inertiajs/vue3'
import createServer from '@inertiajs/vue3/server'
import {renderToString} from '@vue/server-renderer'
import { createSSRApp, DefineComponent, h} from 'vue'
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers";
import {i18nVue} from "laravel-vue-i18n";
import {VueReCaptcha} from "vue-recaptcha-v3";
import PageInterface from "@interfaces/PageInterface";

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


createServer(page =>
    createInertiaApp({
        page,
        render: renderToString,
        resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),

        setup({ App, props, plugin }) {
            const pageProps = props.initialPage.props as unknown as PageInterface;
            const captcheKey = pageProps.pageProps.recaptcha_site_key as string;
            createSSRApp({ render: () => h(App, props) })
                .use(i18nVue, {
                    resolve: langResolver,
                })
                .use(VueReCaptcha, {
                    siteKey: captcheKey,
                    loaderOptions: {}
                })
                .use(plugin)
        },
    })
)
