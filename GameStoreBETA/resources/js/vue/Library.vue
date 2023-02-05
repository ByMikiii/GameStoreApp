<template>
    <section
        id="private-chat"
        v-if="!this.noGames"
        class="bg-bg-color relative border-2 rounded-sm flex mx-auto"
    >
        <div class="flex-grow">
            <h1 class="text-center text-2xl border-b p-1">
                My Games <small>({{ this.gamelist.length }})</small>
            </h1>

            <ul class="h-full">
                <li
                    id="friend"
                    class="border-b p-2 cursor-pointer"
                    v-for="(game, index) in gamelist"
                    :key="index"
                    @click="changeCurrentGame(game)"
                    v-bind:class="
                        game.name === this.currentGame.name
                            ? 'bg-green-500'
                            : null
                    "
                >
                    <span>{{ game.name }}</span>
                </li>
                <a href="/" class="text-xl">
                    <span> + </span>
                </a>
            </ul>
        </div>
        <div id="private-chat" class="w-3/4 flex flex-col border-l">
            <h1 class="text-center text-2xl border-b p-1">
                {{ this.currentGame.name }}
            </h1>

            <div
                class="h-full overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color"
            >
                <h1>{{ this.currentGame.description }}</h1>
            </div>
        </div>
    </section>
    <h1 v-if="this.noGames" class="text-5xl text-center mt-72">
        You have no games. 🥲
    </h1>
</template>

<script>
export default {
    props: ["games", "currentgamee"],
    data() {
        return {
            noGames: false,
            gamelist: this.games,
            currentGame: this.currentgamee,
        };
    },
    methods: {
        changeCurrentGame(gamee) {
            this.currentGame = gamee;
        },
    },
    updated() {},
};
</script>

<style></style>
