<template>
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

            </div>
        </div>

    </div>
    <div class="col  ">
        <div class="row d-flex  container mt-1">
            <div>
                <h6>Delivered At</h6>
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
                <div v-if="order.order_status==2" class="align-self-center border bg-gray py-2 rounded-pill px-5 ">
                    <a href="#" @click.prevent="returnProduct(product.id)" class="fw-5">Return Product</a>
                </div>
                <div v-else class="align-self-center border bg-gray py-2 rounded-pill px-5">
                    <a href="#" class="fw-5">Cancel Product</a>
                </div>

            </div>

        </div>

    </div>
</div>
</template>

<script>
export default {
    props: ['orders'],

    methods: {
        returnProduct(id) {
            this.$router.push({ path: '/return-product', query: { cart_id: id } });

        }
    }

}
</script>

<style scoped>
.reduce-space {
    margin-bottom: 0px !important;
}
</style>
