import Vue from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'
import VueSession from 'vue-session'
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'

window.$ = window.jQuery = require('jquery');
Vue.use(VueFormWizard);
var options = {
    persist: true,
    expireSessionCallback: function () {
        window.location.href = '/'
    }
}
Vue.use(VueSession, options)
Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
