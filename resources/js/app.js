import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp ,Link  } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
//swal alert
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app= createApp({ render: () => h(App, props) })
            app.use(plugin)
            app.use(ZiggyVue)
            app.component('Link', Link)
            app.use(ElementPlus)
            app.use(VueSweetalert2),
            window.Swal=app.config.globalProperties.$swal
            app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
