
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VeeValidate, {Validator} from 'vee-validate';
import de from 'vee-validate/dist/locale/de';

const config = {
    classes: true,
};

Vue.use(VeeValidate, config);
Validator.localize('de', de);

Vue.component('invite', require('./components/Invite.vue'));
Vue.component('competition', require('./components/Competition.vue'));

const app = new Vue({
    el: '#app'
});
