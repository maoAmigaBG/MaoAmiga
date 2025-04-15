import { createRouter, createWebHistory } from 'vue-router'

import Home from '../Home.vue'
import Ong from '../Ong.vue'
import Sobre from '../Sobre.vue'

const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/ong', name: 'ONGs', component: Ong },
  { path: '/sobre', name: 'Sobre', component: Sobre },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
