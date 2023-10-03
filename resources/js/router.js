import { createRouter, createWebHistory } from 'vue-router';



import RazorPay from './components/RazorPay.vue';
import ProductReturn from './components/ProductReturn.vue';

const routes = [
  {
    path: '/razorpay-payment',
    component: RazorPay,
    name: 'razorpay-payment',
  },
  
  // {
  //   path: '/return-product',
  //   component: ProductReturn,
  //   name: 'ReturnProduct',
  // },
  

];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;

