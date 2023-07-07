import '../css/app.css';
// import { createApp, h } from 'vue';
// import { createInertiaApp } from '@inertiajs/vue3';
// import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

// createInertiaApp({
//     resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
//     // resolve: (name) => {
//     //   var teste  = `./Pages/${name}.vue`
//     //   console.log('nome esta aqi ',teste)
//     //   resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
//     //   // require(`./Pages/${name}.vue`)
//     // },
//     setup({ el, app, props, plugin }) {
//         createApp({ render: () => h(app, props) })
//         .use(plugin)
//         .mount(el);
//     },
// });
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})