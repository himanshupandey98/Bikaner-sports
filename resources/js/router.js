import { createRouter, createWebHistory } from 'vue-router';



import RazorPay from './components/RazorPay.vue';

const routes = [
  {
    path: '/razorpay-payment',
    component: RazorPay,
    name: 'razorpay-payment',
  },
  
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;

