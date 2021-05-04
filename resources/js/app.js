import Vue from 'vue'
window.Vue = require('vue');
require('./bootstrap');

Vue.component('top', require('./components/Top.vue').default);

const app = new Vue({
    el: '#app'
});