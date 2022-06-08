import { createRouter, createWebHistory } from 'vue-router'
import Homepage from '../views/Homepage.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Report from '../views/Report.vue'


const routes = [
  {
    path: '/stock',
    name: 'HomePage',
    component: Homepage,
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path:'/register',
    name: 'Register',
    component: Register
  },
  {
    path:'/report',
    name: 'Report',
    component: Report
  },
  {
    path: '/:pathMatch(.*)*',
    redirect: '/login'
  },
  {
    path: '/',
    redirect: '/login'
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
