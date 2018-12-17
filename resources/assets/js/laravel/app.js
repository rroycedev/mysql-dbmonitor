/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.Vue.use(require('vue-cookies'))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('monitor', require('./components/MonitorComponent.vue'));
Vue.component('monitor-filterbar-component', require('./components/MonitorFilterbarComponent.vue'));
Vue.component('appmenu', require('./components/MenuComponent.vue'));
Vue.component('appheader', require('./components/HeaderComponent.vue'));
Vue.component('appfooter', require('./components/FooterComponent.vue'));
Vue.component('detailsnav', require('./components/DetailsNavBarComponent.vue'));
Vue.component('detailscontent', require('./components/DetailsContentComponent.vue'));
Vue.component('detailscomponent', require('./components/DetailsComponent.vue'));

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'


Vue.use(BootstrapVue);

const menuApp = new Vue({
     el: '#app-menu'

});

const headerApp = new Vue({
     el: '#app-header'

});

const footerApp = new Vue({
     el: '#app-footer'

});

const app = new Vue({
     el: '#app'

});