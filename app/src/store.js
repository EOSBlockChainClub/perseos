import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    eos: null,
    user: null,
  },
  mutations: {
    setEos (state, eos) {
      state.eos = eos
    },
    setUser (state, user) {
      state.user = user
    }
  },
  getters: {
    isUser: state => {
      return state.user != null
    }
  },
  actions: {
    setEos ({commit}, eos) {
      commit('setEos', eos)
    },
    setUser ({commit}, user) {
      commit('setUser', user)
    }
  }
})
