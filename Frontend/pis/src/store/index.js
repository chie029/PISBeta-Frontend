import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import VueAxios from 'vue-axios'
 
Vue.use(VueAxios, axios)
Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    app_url: 'http://localhost:9000',
    api_host : 'charlie',
  },
  mutations: {
  },
  actions: {
  },
  modules: {
  }
})
