<template>
    <stripe-checkout
        ref="checkoutRef"
        :pk="publishableKey"
        :sessionId="sessionId"
    />
    <div class="h-10">
        <input
            v-model="amount"
            type="number"
            min="5"
            placeholder="€"
            class="text-black w-14 h-8 text-xl text-center mr-6"
        />
        <button class="mybutton bg-green-500 h-8" @click="submit">
            Zaplatiť
        </button>
    </div>
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
