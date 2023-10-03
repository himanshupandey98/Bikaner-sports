<template>
<div v-if="isCustomerOrders">
    <div class="text-center mt-2 mb-5">
        <h4>My Orders</h4>
    </div>

    <div class="container border border-secondary mb-3 w-75" v-for="order in orders" :key="order">

        <div class="col bg-gray   ">
            <div class="row d-flex justify-content-between mt-1 pt-1">
                <div class="col-2 reduce-space">
                    <h6>Order Placed</h6>
                    <span>{{ order.created_at }}</span>
                </div>
                <div class="col-2 reduce-space">
                    <h6>Total</h6>
                    <span>{{'Rs.'+order.amount+'/-'}}</span>

                </div>
                <div class="col-2 reduce-space">
                    <h6>Shipped to</h6>
                    <span></span>

                </div>

                <div class="col-2 reduce-space">
                    <h6>Order Id</h6>
                    <span>{{'#'+order.order_id}}</span>

                </div>
                <div class="col-2 reduce-space">
                    <h6>Order Status</h6>
                    <span>{{order.order_status}}</span>
                    <div v-if="order.order_status=='Payment Not Done'">
                        <a href="" @click.prevent="RazorPay(order.order_id)" @mouseover="UnderLine('pay-now')" @mouseleave="RemoveUnderLine('pay-now')" id="pay-now">Pay Now</a>

                    </div>

                </div>
            </div>

        </div>
        <div class="col  ">
            <div class="row d-flex  justify-content-between mt-1 px-2">
                <div>
                    <h6>Delivered At</h6>
                </div>
                <div class="" style="margin-right:6%">
                    <a href="#" v-if="order.order_status!='Delivered'" class="fw-5" @mouseover="UnderLine('cancel-order')" @mouseleave="RemoveUnderLine('cancel-order')" @click.prevent="CancelOrder(order.id)" id="cancel-order">Cancel order</a>
                    <a href="#" v-else class="fw-5" @mouseover="UnderLine('return-order')" @mouseleave="RemoveUnderLine('return-order')" @click.prevent="ReturnOrder(order.order_id)" id="return-order">Return order</a>
                </div>

            </div>

            <div class="d-flex border justify-content-between rounded p-3 mb-1" v-for="product in order.cart" :key="product">
                <div class=" d-flex">
                    <img :src="product.product_image" alt="" style="height:100px;width:100px">
                    <div class="d-block mx-3">
                        <h6>{{product.product_sku}}</h6>
                        <p>Price : {{'Rs.'+product.product_price+'/-'}}</p>
                        <p>Quantity : {{product.product_qty}}</p>
                    </div>
                </div>
                <div class="d-block">
                    <div class="align-self-center border bg-gray py-2 rounded-pill px-5 mb-1">
                        <a href="#" class="fw-5">View Product</a>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <PopUp :message="message" />
</div>
</template>

<script>
import PopUp from './PopUp.vue';
export default {
    props: ['orders'],
    components: {
        PopUp
    },
    computed: {
        isCustomerOrders() {
            return this.$route.path === '/customer-orders';
        },
    },
    data() {
        return {
            message: ''
        }
    },

    methods: {
        ReturnOrder(id) {

            confirm('Are you sure you want to return this order?');
            axios.get('/api/return-order-request?order_id=' + id)
                .then((response) => {

                    this.message = response.data.message;

                    // setInterval(() => {
                    //     window.location.reload();
                    // }, 3000);
                })
                .catch((error) => {
                    this.message = error.message;

                })

        },
        RazorPay(order_id) {
            this.$router.push('/razorpay-payment?order_id=' + order_id);

        },
        CancelOrder(id) {
            confirm('Are you sure you want to cancel this order?');
            axios.post('/api/cancel-order', {
                    order_id: id
                })
                .then((response) => {

                    this.message = response.data.message;

                    setInterval(() => {
                        window.location.reload();
                    }, 3000);
                })
                .catch((error) => {
                    console.log(error);
                })

        },
        UnderLine(id) {
            $('#' + id).css('text-decoration', 'underline');
        },
        RemoveUnderLine(id) {
            $('#' + id).css('text-decoration', 'none');
        }
    }

}
</script>

<style scoped>
.reduce-space {
    margin-bottom: 0px !important;
}
</style>
