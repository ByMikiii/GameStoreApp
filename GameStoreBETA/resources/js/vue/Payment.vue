<template>
    <stripe-checkout
        ref="checkoutRef"
        :pk="publishableKey"
        :sessionId="sessionId"
    />
    <input
        v-model="amount"
        type="number"
        min="5"
        placeholder="€"
        class="text-black"
    />
    <button @click="submit">Pay now!</button>
</template>

<script>
import { StripeCheckout } from "@vue-stripe/vue-stripe";
import axios from "axios";

export default {
    components: {
        StripeCheckout,
    },
    updated() {
        console.log(this.publishableKey);
    },
    data() {
        return {
            amount: 10,
            sessionId: null,
            publishableKey: process.env.STRIPE_PUBLISHER_KEY,
        };
    },
    methods: {
        submit() {
            axios.get("getSession/" + this.amount).then((res) => {
                this.sessionId = res.data.id;

                this.$refs.checkoutRef.redirectToCheckout();
            });
        },
    },
};
</script>

<style></style>
