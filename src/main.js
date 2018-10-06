// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue';
import App from './App';
import router from './router';
import VeeValidate from 'vee-validate';
import VueToastr from '@deveodk/vue-toastr';
import BootstrapVue from 'bootstrap-vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueI18n from 'vue-i18n';
import { i18nConfig, toastrConfig } from './config/config';
import store from './store/index';

// Import global styles
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.config.productionTip = false;

Vue.use(BootstrapVue);
Vue.use(VueAxios, axios);
Vue.use(VeeValidate);
Vue.use(VueToastr, toastrConfig);
Vue.use(VueI18n);

const i18nObject = new VueI18n(i18nConfig);

Object.defineProperty(Vue.prototype, '$locale', {
  get: function () {
    return i18nObject.locale;
  },
  set: function (locale) {
    i18nObject.locale = locale;
  }
});

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router: router,
  store: store,
  components: { App },
  i18n: i18nObject,
  template: '<App/>'
})
