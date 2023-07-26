// store.js

import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({

    state: {
        cart: [],
        cartItemCount: 0
    },
    mutations: {
        setCartItems(state, cartItems) {
            state.cart = cartItems;
            state.cartItemCount = cartItems.length;
        },


    },
    actions: {
        async setCartItems(context) {
            try {
                const response = await axios.get('/get-cart-items');
                const cartItems = response.data.data;
                context.commit('setCartItems', cartItems);
            } catch (error) {
                console.error('Error fetching cart items:', error);

            }
        },
        async removeItemFromCart(context, itemId) {
            const response = await axios.post('/delete-cart-item', {
                id: itemId
            });

            if (response.data.status === 'success') {
                const cartItems = response.data.data;
                context.commit('setCartItems', cartItems);
            }
            else {
                console.error('Error removing item from cart:', response.data.message);
            }
        },
        async addToCart(context, data) {
            return new Promise((resolve, reject) => {

                axios.post('/add-to-cart', data)
                    .then((response) => {
                        context.commit('setCartItems', response.data.data);

                        const data = response.data.message;
                        resolve(data);
                    })
                    .catch((error) => {
                        reject(error.data.message);
                    });
            });

        },
        async updateCartQuantity(context, data) {
            return new Promise((resolve, reject) => {

                axios.post('/update-cart-quantity', data)
                    .then((response) => {
                        context.commit('setCartItems', response.data.data);

                        const data = response.data.message;
                        resolve(data);
                    })
                    .catch((error) => {
                        reject(error.data.message);
                    });
            });
        }

    },
    getters: {
        getCartItems(state) {
            return state.cart;
        },
        cartItemsCount(state) {
            return state.cartItemCount;
        },
        getTotalPrice(state) {
            return state.cart.reduce((total, product) => total + Number(product.product_price * product.product_qty), 0);

        },

    },
});
