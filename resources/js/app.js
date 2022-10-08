require('./bootstrap');

import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { createApp, h } from 'vue';
import VueHtmlToPaper from '../plugins/VueHtmlToPaper';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const options = {
    name: '_blank',
    specs: [
      'fullscreen=yes',
      'titlebar=yes',
      'scrollbars=no'
    ],
    styles: [
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        'https://unpkg.com/kidlat-css/css/kidlat.css',
        'public/printStyles.css'
    ],
    timeout: 1000, // default timeout before the print window appears
    autoClose: false, // if false, the window will not close after printing
    windowTitle: window.document.title, // override the window title
  }

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .use(VueHtmlToPaper, options)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
