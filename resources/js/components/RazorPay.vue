
<template>
<div>
    <button id="rzp-button1" @click="pay">Pay</button>
</div>
</template>

<script>
export default {
    mounted() {
        this.loadRazorpayScript();
    },
    methods: {
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
    },
    data() {
        return {
            options: {
                key: 'rzp_test_aCr7DTwOQRRkvp',
                amount: '50000',
                currency: 'INR',
                name: 'Acme Corp',
                description: 'Test Transaction',
                image: 'https://example.com/your_logo',
                order_id: 'order_MJxplc7xQVodxQ',
                handler: this.onPaymentSuccess,
                prefill: {
                    name: 'Gaurav Kumar',
                    email: 'gaurav.kumar@example.com',
                    contact: '9000090000',
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
