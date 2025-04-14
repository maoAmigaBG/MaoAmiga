import { createRouter, createWebHistory } from 'vue-router'

import Home from '../Home.vue'

const routes = [
  { path: '/', name: 'Home', component: Home },/* 
  { path: '/images', name: 'Images', component: Images }, */
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
