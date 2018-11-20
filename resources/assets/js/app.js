
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader

Vue.use(Vuetify)

// Helpers
import colors from 'vuetify/es5/util/colors'

Vue.use(Vuetify, {
    theme: {
        primary: colors.red.darken1, // #E53935
        secondary: colors.red.lighten4, // #FFCDD2
        accent: colors.indigo.base // #3F51B5
    }
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('cliente-sd', require('./components/ClientesSinDeuda.vue'));
Vue.component('cliente', require('./components/ClienteTable.vue'));
Vue.component('nav-bar-admin', require('./components/NavBarAdmin.vue'));
Vue.component('nav-bar-user', require('./components/NavBarUser.vue'));
Vue.component('cliente-crear', require('./components/ClienteCreate.vue'));
Vue.component('cliente-edit', require('./components/ClienteEdit.vue'));

Vue.component('dashboard', require('./components/Dashboard.vue'));


Vue.component('login', require('./components/Login.vue'));

const app = new Vue({
    el: '#app'
});

