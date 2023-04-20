<template>
    <h1 class="text-3xl heading mb-5'">Nákupný košík</h1>

    <div
        id="invoices"
        class="rounded-md mx-auto text-center overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color w-9/12"
    >
        <h1 v-if="isEmpty" class="my-56 text-4xl heading">
            Váš nákupný košík je prázdny 🥲
        </h1>
        <a
            class="mt-8 flex flex-wrap bg-scnd-color rounded-md"
            v-for="basketitem in this.basket_items"
            :href="'/game/' + basketitem.slug"
        >
            <img
                class="w-48 rounded-l-md"
                :src="
                    '//localhost:3000/images/games/' +
                    basketitem.slug +
                    '/banner-1.jpg'
                "
                alt=""
            />
            <div class="text-left ml-4">
                <span class="heading text-2xl mt-4">{{ basketitem.name }}</span>
                <span class="text-gray-400">{{
                    basketitem.publisher.name
                }}</span>
            </div>

            <span
                class="heading text-xl mt-16 ml-auto"
                v-if="basketitem.is_sale === 0"
                >{{ basketitem.original_price }}€</span
            >
            <span
                class="heading text-xl mt-16 ml-auto"
                v-if="basketitem.is_sale === 1"
                >{{ basketitem.sale_price }}€</span
            >

            <span class="mr-2 mt-1">
                <svg
                    class="w-4 fill-red-500 hover:fill-red-600 cursor-pointer mr-0.5"
                    @click="removeItem(basketitem)"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 320 512"
                >
                    <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"
                    />
                </svg>
            </span>
        </a>
    </div>
    <div class="flex w-9/12 mx-auto mt-24">
        <span class="text-left w-full"
            >CELKOVÁ CENA: {{ this.total_price + " €" }}</span
        >
        <a href="/"
            ><button
                class="mybutton bg-blue-400 text-black h-8 mt-1 w-64 mr-3 hover:brightness-125"
            >
                Pokračovať v nakupovaní
            </button></a
        >
        <button
            class="mybutton bg-yellow-400 text-black h-8 mt-1 w-32 hover:brightness-125"
            @click="makePurchase"
        >
            Zaplatiť
        </button>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: ["basketitems", "totalprice"],
    data() {
        return {
            total_price: this.totalprice,
            basket_items: this.basketitems,
            isEmpty: null,
        };
    },
    methods: {
        removeItem(item) {
            if (item.is_sale == 0) {
                this.total_price -= item.original_price;
            } else {
                this.total_price -= item.sale_price;
            }
            this.basket_items.splice(this.basket_items.indexOf(item), 1);
            axios
                .delete("/basket/delete/" + item.id)
                .then(this.recalculateBasketItems());
        },
        recalculateBalance() {
            axios.get("/loggedUserBalance").then((response) => {
                document.getElementById("balance").innerHTML =
                    response.data + " €";
            });
        },
        recalculateBasketItems() {
            axios.get("/basketItems").then((response) => {
                document.getElementById("basketitemscount").innerHTML =
                    response.data;
            });
        },
        makePurchase() {
            axios.post("makePurchase").then((e) => {
                this.recalculateBalance();
                this.recalculateBasketItems();
            });
            this.basket_items.forEach((basketitem) => {
                axios.delete("/basket/delete/" + basketitem.id);
            });

            this.basket_items = {};
            this.total_price = 0;
        },
    },
    updated() {
        this.total_price = Math.round(this.total_price * 100) / 100;
        if (this.basket_items.length === 0) {
            this.isEmpty = true;
        } else {
            this.isEmpty = false;
        }
    },
};
</script>

<style></style>
