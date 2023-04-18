<template>
    <stripe-checkout
        ref="checkoutRef"
        :pk="publishableKey"
        :sessionId="sessionId"
    />
    <div class="h-10 flex w-full">
        <div class="border-b pl-2 pr-1 rounded-sm ml-auto pt-0.5">
            <input
                v-model="amount"
                type="number"
                min="5"
                max="10"
                class="w-10 text-xl text-right bg-bg-color focus:outline-none"
            />
            <span class="ml-1.5 text-2xl my-auto pt-0.5 text-tx-color text-left"
                >€</span
            >
        </div>
        <button
            class="mybutton bg-scnd-color mr-auto px-2 py-1 ml-10 hover:brightness-110 hover:text-tx-color"
            @click="submit"
        >
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
</script>

<style></style>
