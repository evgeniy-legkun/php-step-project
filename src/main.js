// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue';
import App from './App';
import router from './router';
import VeeValidate from 'vee-validate';
import VueToastr from '@deveodk/vue-toastr'
import RuTranslation from './translation/translation.ru';
import EnTranslation from './translation/translation.en';

import BootstrapVue from 'bootstrap-vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueI18n from 'vue-i18n';

// Import global styles
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.config.productionTip = false;

const i18nConfig = {
  locale: 'en', // ru
  messages: {
    en: EnTranslation,
    ru: RuTranslation
  }
};

Vue.use(BootstrapVue);
Vue.use(VueAxios, axios);
Vue.use(VeeValidate);
Vue.use(VueToastr, {
  defaultPosition: 'toast-top-right',
  defaultType: 'info',
  defaultTimeout: 2500
});
Vue.use(VueI18n);

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  i18n: new VueI18n(i18nConfig),
  template: '<App/>'
})
