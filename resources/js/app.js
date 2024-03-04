import './bootstrap';
import '../css/app.css';
import 'vue3-toastify/dist/index.css'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import store from './Store'
import {createPinia} from 'pinia'
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faUserSecret, faCity, faShop, faEdit, faTrash, faPlus, faWindowClose, faClose, faArrowLeft, faPaperPlane } from '@fortawesome/free-solid-svg-icons'
library.add(faUserSecret, faCity, faShop, faEdit, faTrash,faPlus, faWindowClose, faClose, faArrowLeft, faPaperPlane)
const appName = import.meta.env.VITE_APP_NAME || 'Smart Fast Buy';
const pinia = createPinia()
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(store)
            .use(pinia)
            .component('font-awesome-icon', FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
