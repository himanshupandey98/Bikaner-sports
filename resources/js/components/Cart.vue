<template>
<div>
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Shopping Cart</h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">
                <div class="container" v-if="cartItemsCount">
                    <div class="row">
                        <div class="col-lg-9">
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="item in cartItems" :key="item.id">
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="#" @click.prevent>
                                                        <img :src="item.product_image" alt="Product image">
                                                    </a>
                                                </figure>

                                                <h3 class="product-title">
                                                    <a href="#">{{ item.product_sku }}</a>
                                                </h3><!-- End .product-title -->
                                            </div><!-- End .product -->
                                        </td>
                                        <td class="price-col">{{'Rs.'+item.product_price+'/-'}}</td>
                                        <td class="quantity-col">
                                            <div class="cart-product-quantity">
                                                <input type="number" class="form-control" :value="item.product_qty" min="1" max="10" step="1" data-decimals="0" required @change="handleQuantityClick(item.id)">
                                            </div>
                                        </td>
                                        <td class="total-col">{{'Rs.'+Number(item.product_price)*Number(item.product_qty)+'/-'}}</td>
                                        <td class="remove-col"><button class="btn-remove" @click="deleteCartItem(item.id)"><i class="icon-close"></i></button></td>
                                    </tr>

                                </tbody>
                            </table><!-- End .table table-wishlist -->

                            <div class="cart-bottom">
                                <div class="cart-discount">
                                    <form action="#">
                                        <div class="input-group">
                                            <input type="text" class="form-control" required placeholder="coupon code">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                            </div><!-- .End .input-group-append -->
                                        </div><!-- End .input-group -->
                                    </form>
                                </div><!-- End .cart-discount -->

                                <!-- <a href="#" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></a> -->
                            </div><!-- End .cart-bottom -->
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <tbody>
                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>{{ 'Rs.'+total+'/-' }}</td>
                                        </tr><!-- End .summary-subtotal -->
                                        <tr class="summary-shipping">
                                            <td>Shipping:</td>
                                            <td>&nbsp;</td>
                                        </tr>

                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="free-shipping" name="shipping" class="custom-control-input" checked>
                                                    <label class="custom-control-label" for="free-shipping">Free Shipping</label>
                                                </div><!-- End .custom-control -->
                                            </td>
                                            <td>Rs.0/-</td>
                                        </tr>

                                        <tr class="summary-shipping-estimate">
                                            <td>Estimate for Your Country<br> <a href="dashboard.html" @click.prevent>Change address</a></td>
                                            <td>&nbsp;</td>
                                        </tr><!-- End .summary-shipping-estimate -->

                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>{{ 'Rs.'+total+'/-' }}</td>
                                        </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->

                                <a href="/checkout-page" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                            </div><!-- End .summary -->

                            <a href="category.html" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                        </aside><!-- End .col-lg-3 -->
                    </div>
                </div><!-- End .container -->
                <div v-else class="container text-center">
                    <h4>No items in cart.</h4>
                </div>
            </div><!-- End .cart -->
        </div><!-- End .page-content -->
    </main>
</div>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch('setCartItems');

    },
    computed: {
        cartItems() {
            return this.$store.getters.getCartItems;
        },
        cartItemsCount() {
            return this.$store.getters.cartItemsCount;
        },
        total() {
            return this.$store.getters.getTotalPrice;
        }
    },
    data() {
        return {

        }
    },

    methods: {
        deleteCartItem(id) {
            this.$store.dispatch('removeItemFromCart', id);
        },
        handleQuantityClick(id) {
            this.$store.dispatch('updateCartQuantity', {
                id: id,
                qty: event.target.value
            });
        }
    }

}
</script>

<style>

</style>
