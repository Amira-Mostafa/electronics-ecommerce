console.log('app.js is loaded');
import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import { routes } from './routes';
import App from './components/App.vue';
import { store } from './store'

// Create the router instance
const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
});

createApp(App)
    .use(router)
    .use(store)
    .mount('#app');





// import Vue from 'vue';
// import VueRouter from 'vue-router';
// import { routes } from './routes';
// import App from './components/App.vue';

// Vue.use(VueRouter);
// const router = new VueRouter({
//     routes: routes,
//     mode: 'histroy',
// });

// new Vue({
//     render: (h) => h(App),
//     router: router
// }).$mount('#app');
