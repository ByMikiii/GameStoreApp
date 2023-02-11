<template>
    <section
        id="private-chat"
        class="bg-scnd-color w-5/6 relative rounded-md flex mx-auto"
    >
        <div class="flex-grow">
            <h1 class="text-center text-2xl p-1 heading">
                Games <small>({{ this.gamelist.length }})</small>
            </h1>

            <ul class="h-full text-left">
                <li
                    id="game"
                    class="cursor-pointer flex"
                    v-for="(game, index) in this.gamelist"
                    :key="index"
                    @click="changeCurrentGame(game)"
                    v-bind:class="
                        game.name === this.currentGame.name
                            ? 'bg-amber-500'
                            : null
                    "
                >
                    <div class="p-2.5">
                        <span class="truncate w-5/6">{{ game.name }}</span>
                    </div>
                </li>
            </ul>
        </div>
        <div
            id="private-chat"
            class="w-3/4 flex flex-col border-l border-bg-color"
        >
            <h1 class="text-center text-2xl p-1 heading">
                {{ this.currentGame.name }}
            </h1>
        </div>

        <div
            ref="privateChat"
            class="h-full overflow-x-hidden overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color p-4"
        ></div>
    </section>
</template>

<script>
export default {
    props: ["games", "currentgamee"],
    data() {
        return {
            noGames: true,
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
