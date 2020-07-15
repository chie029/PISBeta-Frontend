import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../views/Login.vue'

// Forgotten Password
import ForgotPassword from '../views/ForgotPassword/ForgotPassword.vue'
import ChangePassword from '../views/ForgotPassword/ChangePassword.vue'

// Home
import Dashboard from '../views/Dashboard.vue'

// Employee
import Employee from '../views/Employee/Employee.vue'
import CreateEmployee from '../views/Employee/CreateEmployee.vue'

// User
import CreateUser from '../views/User/CreateUser.vue'

// Company
import Company from '../views/Company/Company.vue'
import CreateCompany from '../views/Company/CreateCompany.vue'
import ShowCompany from '../views/Company/ShowCompany.vue'

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
    path: '/Employee',
    name: 'Employee',
    component: Employee
  },
  {
    path: '/Employee/CreateEmployee',
    name: 'CreateEmployee',
    component: CreateEmployee
  },
  {
    path: '/User/CreateUser',
    name: 'CreateUser',
    component: CreateUser
  },
  {
    path: '/Company',
    name: 'Company',
    component: Company
  },
  {
    path: '/Company/CreateCompany',
    name: 'CreateCompany',
    component: CreateCompany
  },
  {
    path: '/Company/ShowCompany/:id',
    name: 'ShowCompany',
    component: ShowCompany
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
