import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../views/Login.vue'

// Forgotten Password
import ForgotPassword from '../views/ForgotPassword/ForgotPassword.vue'
import ChangePassword from '../views/ForgotPassword/ChangePassword.vue'

// Home
import Dashboard from '../views/Dashboard.vue'

// Employee
import CreateEmployee from '../views/Employee/CreateEmployee.vue'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login
  },
  {
    path: '/Dashboard',
    name: 'Dashboard',
    component: Dashboard
  },
  {
    path: '/ForgotPassword',
    name: 'ForgotPassword',
    component: ForgotPassword
  },
  {
    path: "/ChangePassword/:email/:id/",
    name: "ChangePassword",
    component: ChangePassword
  },
  {
    path: '/CreateEmployee',
    name: 'CreateEmployee',
    component: CreateEmployee
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
