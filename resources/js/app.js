
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');
// require('./resources/js/env').config();

window.Vue = require('vue');
import {VueMasonryPlugin} from 'vue-masonry';
import VueRouter from 'vue-router'

let axios = require('axios');
// const app = createApp(MyApp)
// app.use(VueRouter)


Vue.use(VueRouter)
Vue.use(VueMasonryPlugin);
// Vue.component('dashboard', require('./components/Dashboard.vue').default);
Vue.component('contacts', require('./components/Contacts.vue').default);
Vue.component('dewpoint', require('./components/Dewpoint.vue').default);
Vue.component('slider', require('./components/Slider.vue').default);
Vue.component('masonry', require('./components/Masonry.vue').default);
Vue.component('greeting', require('./components/Greeting.vue').default);
Vue.component('testimonials', require('./components/Testimonials.vue').default);
Vue.component('spotify', require('./components/Spotify.vue').default);
Vue.component('skills', require('./components/Skills.vue').default);
Vue.component('kungfu', require('./components/Kungfu.vue').default);
Vue.component('contactme', require('./components/Contactme.vue').default);
Vue.component('contactmefooter', require('./components/Contactmefooter.vue').default);

// $.ajaxSetup({
//     // force ajax call on all browsers
//     cache: false,

//     // Enables cross domain requests
//     crossDomain: true,

//     // Helps in setting cookie
//     xhrFields: {
//         withCredentials: true
//     },

//     beforeSend: function (xhr, type) {
//         // Set the CSRF Token in the header for security
//         if (type.type !== "GET") {
//             var token = Cookies.get("XSRF-TOKEN");
//             xhr.setRequestHeader('X-XSRF-Token', token);
//         }
//     }
// });

// 0. If using a module system (e.g. via vue-cli), import Vue and VueRouter
// and then call `Vue.use(VueRouter)`.

// 1. Define route components.
// These can be imported from other files
import Vue from 'vue'
import Detail from './components/Detail.vue';

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
const routes = [
 {path: '/detail/',  component: Detail},
 {path: '/detail/:bu', name: 'detail', component: Detail },
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  routes // short for `routes: routes`
})

// 4. Create and mount the root instance.
// Make sure to inject the router with the router option to make the
// whole app router-aware.
// const app = new Vue({
//   router
// }).$mount('#app')


// base app
const app = new Vue({
  router,
  el: '#app'
})

//masonry
const vm = new Vue({
  router,
  el: '#vue-instance',
});

//about section
const about = new Vue({
  el: '#about',
});

//footer
const aboutFooter = new Vue({
  el: '#aboutFooter',
});
