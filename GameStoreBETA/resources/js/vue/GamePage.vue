<template>
    <button class="button" @click="addToBasket">Add To Basket</button>
</template>

<script>
export default {
    props: ["game"],
    data() {
        return {};
    },
    methods: {
        recalculateBasketItems() {
            axios.get("/basketItems").then((response) => {
                document.getElementById("basketitemscount").innerHTML =
                    response.data;
            });
        },
        addToBasket() {
            axios
                .post("/addToBasket/" + this.game.id)
                .then(this.recalculateBasketItems());
        },
    },
    updated() {},
};
</script>

<style></style>
