import { createRouter, createWebHistory } from 'vue-router';



import Cart from './components/Cart.vue';

const routes = [
  {
    path: '/cart',
    component: Cart,
    name: 'cart',
  },
  
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;

