<template>
<div class="" style="margin:10%">
    <button id="rzp-button1" @click="pay" class="btn btn-info ">Pay</button>
</div>
</template>

<script>
export default {
    async mounted() {
        await this.getOrderIdFromRoute();
        await this.loadRazorpayScript();
    },

    methods: {
        async getOrderIdFromRoute() {
            let self = this;

            try {
                const response = await axios.post('/get-order-for-payment', this.$route.query);
                self.options.amount = response.data.data.amount * 100;
                self.options.order_id = response.data.data.razor_order_id;
            } catch (error) {
                console.log(error);
            }

        },
        loadRazorpayScript() {
            const script = document.createElement('script');
            script.src = 'https://checkout.razorpay.com/v1/checkout.js';
            script.async = true;
            script.onload = this.initRazorpay;
            document.body.appendChild(script);
        },
        initRazorpay() {
            this.rzp1 = new window.Razorpay(this.options);
            this.rzp1.on('payment.failed', this.onPaymentFailed);
        },
        pay() {
            this.rzp1.open();
        },
        onPaymentFailed(response) {
            alert(response.error.code);
            alert(response.error.description);
            alert(response.error.source);
            alert(response.error.step);
            alert(response.error.reason);
            alert(response.error.metadata.order_id);
            alert(response.error.metadata.payment_id);
        },
        async onPaymentSuccess(payment_response) {

            try {
                const response = await axios.post('/make-payment', {
                    razorpay_payment_id: payment_response.razorpay_payment_id,
                    razorpay_order_id: this.options.order_id,

                })
                console.log(response);
            } catch (error) {
                console.log(error);
            }
        },
    },
    data() {
        return {
            options: {
                key: 'rzp_test_aCr7DTwOQRRkvp',
                amount: "",
                currency: 'INR',
                name: 'Acme Corp',
                description: 'Test Transaction',
                image: 'https://example.com/your_logo',
                order_id: "",
                handler: this.onPaymentSuccess,
                prefill: {
                    name: 'Gaurav Kumar',
                    email: 'gaurav.kumar@example.com',
                    contact: '7062184323',
                },
                notes: {
                    address: 'Razorpay Corporate Office',
                },
                theme: {
                    color: '#3399cc',
                },
            },

        };
    },
};
</script>

<style>

</style>
