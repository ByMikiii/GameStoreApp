<template>
    <p class="text-left text-4xl">{{ this.game.name }}</p>
    <div class="flex">
        <img
            class="w-1/2"
            src="//localhost:3000/images/games/example.jpg"
            alt="Game Image"
        />
        <span class="">{{ this.game.description }}</span>
    </div>
    <button class="button" @click="addToBasket">Add To Basket</button>
</template>

<script>
export default {
    props: ["game"],
    data() {
        return {};
    },
    methods: {
        addToBasket() {
            axios.post("/addToBasket/" + this.game.id);
        },
    },
    updated() {},
};
</script>

<style></style>
