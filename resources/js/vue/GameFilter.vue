<template>
    <div class="flex mb-5">
        <input
            class="bg-bg-color border-b ml-6 focus:outline-none w-60"
            name="filter-name"
            :placeholder="__('search')"
            v-model="namee"
            type="text"
        />
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
            class="w-4 fill-gray-500 relative right-5 hover:cursor-pointer"
        >
            <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
            <path
                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
            />
        </svg>

        <div class="select ml-auto mr-10">
            <select v-model="genree">
                <option value="" selected>
                    {{ __("genre") }}
                </option>

                <option v-for="genre in genres">
                    {{ genre.genre_name }}
                </option>
            </select>
        </div>

        <div class="select mr-10">
            <select v-model="orderr">
                <option value="" selected>{{ __("sort") }}</option>

                <option value="Lowest price">{{ __("lowestprice") }}</option>
                <option value="Highest price">{{ __("highestprice") }}</option>
                <option value="Newest">{{ __("newest") }}</option>
                <option value="Reviews">{{ __("reviews") }}</option>
            </select>
        </div>

        <button
            class="mybutton bg-scnd-color h-10 rounded-md p-2 px-4 mr-6 hover:brightness-110"
            @click="reset"
        >
            Reset
        </button>
    </div>

    <div id="filtered" v-if="this.isFilter">
        <h1 class="text-3xl heading text-left mb-4">{{ __("found") }}</h1>
        <ol id="games-list" class="h-full mb-16 mx-auto">
            <a
                v-for="foundgame in this.foundGames"
                :href="'/game/' + foundgame.slug"
                class="w-80 h-48 bg-scnd-color rounded-md hover:text-tx-color hover:brightness-110 hover:scale-105 transition-all text-tx-color mb-14 mx-auto"
            >
                <img
                    class="object-cover rounded-t-md w-full h-2/3"
                    :src="'/images/games/' + foundgame.slug + '/banner-1.jpg'"
                    :alt="'Image of ' + foundgame.name"
                />
                <div class="flex text-left h-1/3 p-3">
                    <div class="w-56 truncate">
                        <span class="font-semibold">{{ foundgame.name }}</span>
                        <p class="text-xs text-gray-400">
                            {{ foundgame.publisher.name }}
                        </p>
                    </div>
                    <span
                        class="game-price"
                        v-if="foundgame.current_price === 0"
                    >
                        Free
                    </span>
                    <span class="game-price" v-else>
                        {{ foundgame.current_price + "€" }}
                    </span>
                </div>
            </a>
        </ol>
    </div>

    <div v-if="!this.isFilter">
        <h1 class="text-3xl heading text-left mb-4">{{ __("news") }}</h1>
        <ol id="games-list" class="h-full mb-16 mx-auto">
            <a
                v-for="newgame in this.newgames"
                :href="'/game/' + newgame.slug"
                class="w-80 h-48 bg-scnd-color rounded-md hover:text-tx-color hover:brightness-110 hover:scale-105 transition-all text-tx-color mb-14 mx-auto"
            >
                <img
                    class="object-cover rounded-t-md w-full h-2/3"
                    :src="'/images/games/' + newgame.slug + '/banner-1.jpg'"
                    :alt="'Image of ' + newgame.name"
                />
                <div class="flex text-left h-1/3 p-3">
                    <div class="w-56 truncate">
                        <span class="font-semibold">{{ newgame.name }}</span>
                        <p class="text-xs text-gray-400">
                            {{ newgame.publisher.name }}
                        </p>
                    </div>
                    <span class="game-price" v-if="newgame.current_price === 0">
                        Free
                    </span>
                    <span class="game-price" v-else>
                        {{ newgame.current_price + "€" }}
                    </span>
                </div>
            </a>
        </ol>

        <h1 class="text-3xl heading text-left mb-4">{{ __("sales") }}</h1>
        <ol id="games-list" class="h-full mb-16 mx-auto">
            <a
                v-for="salegame in this.salegames"
                :href="'/game/' + salegame.slug"
                class="w-80 h-48 bg-scnd-color rounded-md hover:text-tx-color hover:brightness-110 hover:scale-105 transition-all text-tx-color mb-14 mx-auto"
            >
                <p
                    class="ml-2 mt-2 absolute heading text-lg w-16 h-14 py-3.5 rounded-lg bg-scnd-color border-bg-color"
                >
                    -{{
                        Math.floor(
                            ((salegame.original_price -
                                salegame.current_price) /
                                salegame.original_price) *
                                100
                        )
                    }}%
                </p>
                <img
                    class="object-cover rounded-t-md w-full h-2/3"
                    :src="'/images/games/' + salegame.slug + '/banner-1.jpg'"
                    :alt="'Image of ' + salegame.name"
                />
                <div class="flex text-left h-1/3 p-3">
                    <div class="w-56 truncate">
                        <span class="font-semibold">{{ salegame.name }}</span>
                        <p class="text-xs text-gray-400">
                            {{ salegame.publisher.name }}
                        </p>
                    </div>
                    <span
                        class="game-price"
                        v-if="salegame.current_price === 0"
                    >
                        Free
                    </span>
                    <span class="game-price" v-else>
                        {{ salegame.current_price + "€" }}
                    </span>
                </div>
            </a>
        </ol>

        <h1 class="text-3xl heading text-left mb-4">{{ __("allgames") }}</h1>
        <ol id="games-list" class="h-full mb-16 mx-auto">
            <a
                v-for="allgame in this.allgames"
                :href="'/game/' + allgame.slug"
                class="w-80 h-48 bg-scnd-color rounded-md hover:text-tx-color hover:brightness-110 hover:scale-105 transition-all text-tx-color mb-14 mx-auto"
            >
                <img
                    class="object-cover rounded-t-md w-full h-2/3"
                    :src="'/images/games/' + allgame.slug + '/banner-1.jpg'"
                    :alt="'Image of ' + allgame.name"
                />
                <div class="flex text-left h-1/3 p-3">
                    <div class="w-56 truncate">
                        <span class="font-semibold">{{ allgame.name }}</span>
                        <p class="text-xs text-gray-400">
                            {{ allgame.publisher.name }}
                        </p>
                    </div>
                    <span class="game-price" v-if="allgame.current_price === 0">
                        Free
                    </span>
                    <span class="game-price" v-else>
                        {{ allgame.current_price + "€" }}
                    </span>
                </div>
            </a>
        </ol>
    </div>
</template>

<script>
export default {
    props: ["genres", "newgames", "salegames", "allgames", "lang"],
    data() {
        return {
            genre: "null",
            name: "null",
            order: "null",
            genree: "",
            namee: "",
            orderr: "",
            isFilter: false,
            foundGames: [],
        };
    },

    methods: {
        submit() {
            if (this.name == "") {
                var game_name = "null";
            } else {
                var game_name = this.name;
            }

            if (this.genre == "") {
                var game_genre = "null";
            } else {
                var game_genre = this.genre;
            }

            if (this.order == "") {
                var order = "null";
            } else {
                var order = this.order;
            }

            axios
                .get("getGame/" + game_name + "/" + game_genre + "/" + order)
                .then((res) => {
                    this.foundGames = res.data;
                    this.isFilter = true;
                });
        },
        reset() {
            this.name = "";
            this.order = "";
            this.genre = "";
            this.namee = "";
            this.orderr = "";
            this.genree = "";
            this.isFilter = false;
        },
    },

    created() {
        this.$lang().setLocale(this.lang);
    },
    updated() {
        if (
            this.name != this.namee ||
            this.order != this.orderr ||
            this.genre != this.genree
        ) {
            this.name = this.namee;
            this.order = this.orderr;
            this.genre = this.genree;
            this.submit();
        }
        if (this.namee === "" && this.orderr === "" && this.genree === "") {
            this.reset();
        }
    },
};
</script>

<style></style>
