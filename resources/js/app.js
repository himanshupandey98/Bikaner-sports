/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

import store from './store';

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

import Home from './components/Home.vue';
app.component('home-component', Home);


import ProductDetail from './components/ProductDetail.vue';
app.component('product-detail', ProductDetail);

import Header from './components/Header.vue';
app.component('header-component', Header);

import Footer from './components/Footer.vue';
app.component('footer-component', Footer);


import Cart from './components/Cart.vue';
app.component('cart-component', Cart);

import Checkout from './components/Checkout.vue';
app.component('checkout-component', Checkout);



app.use(store);

app.mount('#app');
