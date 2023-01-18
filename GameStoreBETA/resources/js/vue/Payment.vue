<template>
    <stripe-checkout
        ref="checkoutRef"
        :pk="publishableKey"
        :sessionId="sessionId"
    />
    <h2 class="text-xl">Add balance</h2>
    <input
        v-model="amount"
        type="number"
        min="5"
        placeholder="€"
        class="text-black w-10 h-6 text-center"
    />
    <button class="button is-success h-6 w-20" @click="submit">Pay now!</button>
</template>

<script>
import { StripeCheckout } from "@vue-stripe/vue-stripe";
import axios from "axios";

export default {
    components: {
        StripeCheckout,
    },
    updated() {},
    data() {
        return {
            amount: 10,
            sessionId: null,
            publishableKey:
                "pk_test_51M30mIE4BzPYXBbZv1N7qDNdVM8mDwDHSELGZrKJqXQjBCYlRJ1vn0p5DCb5gecAY7KJzimoEjpHmbAUVHtiTvQe00JU4Acv2l",
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

console.log();
</script>

<style></style>
