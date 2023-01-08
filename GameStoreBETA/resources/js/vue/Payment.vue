<template>
    <stripe-checkout
        v-if="sessionId"
        ref="checkoutRef"
        :pk="publishableKey"
        :sessionId="sessionId"
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
    mounted() {
        this.getSession();
    },
    data() {
        return {
            sessionId: null,

            publishableKey:
                "pk_test_51M30mIE4BzPYXBbZv1N7qDNdVM8mDwDHSELGZrKJqXQjBCYlRJ1vn0p5DCb5gecAY7KJzimoEjpHmbAUVHtiTvQe00JU4Acv2l",
        };
    },
    methods: {
        getSession() {
            axios.get("getSession").then((res) => {
                this.sessionId = res.data.id;
            });
        },
        submit() {
            this.$refs.checkoutRef.redirectToCheckout();
        },
    },
};
</script>

<style></style>
