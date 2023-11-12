import { createRouter, createWebHistory } from 'vue-router'

import ProductsListVue from '../views/ProductsList.vue'
import CreateProduct from '../views/CreateProduct.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: ProductsListVue
    },
    {
      path: '/create-product',
      name: 'create-product',
      component: CreateProduct
    }
  ]
})

export default router
