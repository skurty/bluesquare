require('./bootstrap');

window.Vue = require('vue').default;

import './bootstrap'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import './../css/app.css'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

import store from './store';

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import { routes } from './routes';

const router = new VueRouter({
    routes,
    mode: 'hash',
})

import App from './components/App';

new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});
