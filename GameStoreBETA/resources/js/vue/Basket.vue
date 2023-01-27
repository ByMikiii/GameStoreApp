<template>
    <div class="mt-2 flex flex-wrap border border-b-0">
        <span class="basket-item h-8">PRODUCT NAME</span>
        <span class="basket-item h-8">QUANTITY</span>
        <span class="basket-item h-8">PRICE</span>
        <span class="basket-item h-8"></span>
    </div>
    <div
        id="invoices"
        class="h-3/5 border mx-auto text-center overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color"
    >
        <!-- <h1 class="my-56 text-4xl">Your basket is empty. 🥲</h1> -->
        <div
            class="mt-2 flex flex-wrap"
            v-for="basketitem in this.basket_items"
        >
            <span class="basket-item">{{ basketitem.name }}</span>
            <span class="basket-item">1</span>
            <span class="basket-item" v-if="basketitem.is_sale === 0">{{
                basketitem.original_price
            }}</span>
            <span class="basket-item" v-if="basketitem.is_sale === 1">{{
                basketitem.sale_price
            }}</span>

            <span class="basket-item"
                ><button
                    class="button h-8 bg-red-600"
                    @click="removeItem(basketitem)"
                >
                    Remove
                </button></span
            >
        </div>
    </div>
    <div class="flex">
        <span class="text-left w-full"
            >TOTAL PRICE: {{ this.total_price + " €" }}</span
        >

        <a href="/"
            ><button class="button bg-gray-500 mr-2 mt-1 hover:text-red-600">
                Continue Shopping
            </button></a
        >
        <button class="button bg-green-500 mt-1" @click="makePurchase">
            Pay Now
        </button>
    </div>
</template>

<script>
import { assertExpressionStatement } from "@babel/types";
import axios from "axios";

export default {
    props: ["basketitems", "totalprice"],
    data() {
        return {
            total_price: this.totalprice,
            basket_items: this.basketitems,
        };
    },
    methods: {
        removeItem(item) {
            if (item.is_sale == 0) {
                this.total_price -= item.original_price;
            } else {
                this.total_price -= item.sale_price;
            }
            this.basket_items.splice(this.basket_items.indexOf(item), 2);
            axios.delete("/basket/delete/" + item.id);
        },
        makePurchase() {
            axios.post("makePurchase");
            this.basket_items.forEach((basketitem) => {
                this.removeItem(basketitem);
            });
        },
    },
    updated() {
        this.total_price = Math.round(this.total_price * 100) / 100;
    },
};
</script>

<style lang="scss" scoped></style>
