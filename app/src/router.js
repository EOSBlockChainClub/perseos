import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import ManageData from './views/ManageData.vue'
import SignIn from './views/SignIn.vue'
import SignUp from './views/SignUp.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/SignIn',
      name: 'signIn',
      component: SignIn
    },
    {
      path: '/SignUp',
      name: 'signUp',
      component: SignUp
    },
    {
      path: '/ManageData',
      name: 'manageData',
      component: ManageData
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
    }
  ]
})
