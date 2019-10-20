
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.Swal = require('sweetalert2');
window.Toastr = require('toastr');
window.Autocomplete = require('@trevoreyre/autocomplete-vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.use(Autocomplete);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('compra-component', require('./components/CompraComponent.vue').default);
Vue.component('venta-component', require('./components/VentaComponent.vue').default);

Vue.component('bar-chart-component', require('./components/BarChartComponent.vue').default);
Vue.component('donut-chart-component', require('./components/DonutChartComponent.vue').default);
Vue.component('line-chart-component', require('./components/LineChartComponent.vue').default);
Vue.component('compra-line-chart-component', require('./components/CompraLinearChartComponent.vue').default);
Vue.component('notificacion-factura-component', require('./components/NotificacionFacturaComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
