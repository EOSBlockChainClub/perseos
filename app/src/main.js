import '@babel/polyfill'
import Vue from 'vue'
import './plugins/vuetify'
import App from './App.vue'
import router from './router'
import store from './store'
import Eosjs from 'eosjs'

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App),
  created: function() {

    this.$store.dispatch('setEos', new Eosjs({
      httpEndpoint: 'http://localhost:8888',
      chainId: 'cf057bbfb72640471fd910bcb67639c22df9f92470936cddc1ade0e2f2e7dc4f'
    }))
  }
}).$mount('#app')
