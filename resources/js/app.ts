import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import {i18nVue} from "laravel-vue-i18n";
import {setUrlDefaults} from "./wayfinder";
setUrlDefaults({
    locale: 'nl',
});
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
    resolve: name => {
        const pages = import.meta.glob('./pages/**/*.vue', { eager: true })
        return pages[`./pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(i18nVue, {
                resolve: langResolver,
            })
            .use(plugin)
            .mount(el)
    },
})
