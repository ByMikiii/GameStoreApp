<template>
    <button
        class="mybutton bg-tx-color p-2 text-black hover:brightness-110 ml-4 mr-auto relative mb-0 mt-auto"
        v-if="this.owngame == 1"
    >
        Túto hru už vlastníš
    </button>

    <button
        class="mybutton bg-tx-color p-2 text-black hover:brightness-110 ml-4 mr-auto relative mb-0 mt-auto"
        @click="addToBasket"
        v-if="this.owngame == 0"
    >
        Pridať do košíku
    </button>
</template>

<script>
export default {
    props: ["game", "owngame"],
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
