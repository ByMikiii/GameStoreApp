<template>
    <section
        id="private-chat"
        class="bg-scnd-color w-5/6 relative rounded-md flex mx-auto"
    >
        <div class="flex-grow">
            <h1 class="text-center text-2xl p-1 heading">
                {{ __("games") }} <small>({{ this.gamelist.length }})</small>
            </h1>

            <ul class="h-full text-left">
                <li
                    id="game"
                    class="cursor-pointer flex hover:brightness-125 hover:bg-gray-500 hover:bg-opacity-5 w-72"
                    v-for="(game, index) in this.gamelist"
                    :key="index"
                    @click="changeCurrentGame(game)"
                    v-bind:class="
                        game.name === this.currentGame.name
                            ? 'bg-yellow-400 text-black hover:brightness-105 hover:bg-yellow-400 hover:bg-opacity-100'
                            : null
                    "
                >
                    <div class="p-2.5 flex">
                        <img
                            class="w-6 h-6 mr-2 rounded-sm object-cover"
                            :src="
                                '//localhost:3000/images/games/' +
                                game.slug +
                                '/banner-1.jpg'
                            "
                            alt="Game "
                        />
                        <span class="truncate w-56">{{ game.name }}</span>
                    </div>
                </li>
            </ul>
        </div>
        <div
            id="private-chat"
            class="flex flex-col border-l rounded-r-md border-bg-color overflow-x-hidden overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color pb-4"
        >
            <h1 class="text-center text-2xl p-1 heading">
                {{ this.currentGame.name }}
            </h1>
            <img
                class="rounded-md w-4/6 mx-auto h-auto m-4"
                :src="
                    '//localhost:3000/images/games/' +
                    this.currentGame.slug +
                    '/banner-1.jpg'
                "
                alt="Game "
            />
            <span class="text-justify mx-24">{{
                this.currentGame.description
            }}</span>

            <button
                class="mybutton bg-blue-400 p-2 mt-4 text-black hover:brightness-110 w-40 mx-auto"
            >
                <a
                    class="hover:text-black"
                    :href="'/game/' + this.currentGame.slug"
                    >{{ __("storepage") }}</a
                >
            </button>
        </div>
    </section>
</template>

<script>
import { isProxy, toRaw } from "vue";

export default {
    props: ["games", "currentgamee", "auth", "lang"],
    data() {
        return {
            noGames: true,
            gamelist: this.games,
            currentGame: this.currentgamee,
            currentGameReviews: null,
        };
    },
    methods: {
        changeCurrentGame(gamee) {
            this.currentGame = gamee;
        },
    },
    created() {
        this.$lang().setLocale(this.lang);
    },
};
</script>

<style></style>
