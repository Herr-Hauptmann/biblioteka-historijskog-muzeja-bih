import '../css/app.css';
import 'flowbite';
import.meta.glob([ '../images/**', ]);

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { VueReCaptcha, useReCaptcha } from 'vue-recaptcha-v3'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Biblioteka Historijskog muzeja Bosne i Hercegovine';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        const captcheKey = props.initialPage.props.recaptcha_site_key;
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(VueReCaptcha, { siteKey: captcheKey } )
            .use(ZiggyVue)
            .mount(el);
    },
});