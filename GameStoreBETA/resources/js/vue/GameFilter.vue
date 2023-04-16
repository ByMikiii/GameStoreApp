<template>
    <div class="flex mb-5">
        <input
            class="bg-bg-color border-b ml-auto mr-10 focus:outline-none"
            name="filter-name"
            placeholder="Search by name"
            v-model="name"
            type="text"
        />

        <div class="select mr-10">
            <select v-model="genre">
                <option value="" selected disabled hidden>
                    Filter by genre
                </option>

                <option value="">All</option>
                <option v-for="genre in genres">
                    {{ genre.genre_name }}
                </option>
            </select>
        </div>

        <div class="select mr-10">
            <select v-model="order">
                <option value="" selected disabled>Order</option>

                <option>Highest price</option>
                <option>Lowest price</option>
                <option>Newest</option>
                <option>Reviews</option>
            </select>
        </div>

        <button
            class="mybutton bg-green-500 h-10 rounded-md p-2 px-4 mr-10 hover:brightness-110"
            @click="submit"
        >
            Submit
        </button>
        <button
            class="mybutton bg-red-500 h-10 rounded-md p-2 px-4 mr-auto hover:brightness-110"
            @click="reset"
        >
            Reset
        </button>
    </div>

    <div id="filtered" v-if="this.isFilter">
        <h1 class="text-3xl heading text-left mb-4">FOUND</h1>
        <ol id="games-list" class="h-full mb-16 mx-auto">
            <a
                v-for="foundgame in this.foundGames"
                :href="'/game/' + foundgame.slug"
                class="w-80 h-48 bg-scnd-color rounded-md hover:text-tx-color hover:brightness-110 hover:scale-110 text-tx-color mb-14 mx-auto"
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
                        class="ml-auto py-2.5 font-semibold"
                        v-if="foundgame.original_price === 0"
                    >
                        Free
                    </span>
                    <span
                        class="ml-auto py-2.5 font-semibold"
                        v-if="foundgame.is_sale === 1"
                    >
                        {{ foundgame.sale_price + "€" }}
                    </span>
                    <span
                        class="ml-auto py-2.5 font-semibold"
                        v-if="foundgame.is_sale === 0"
                    >
                        {{ foundgame.original_price + "€" }}
                    </span>
                </div>
            </a>
        </ol>
    </div>

    <div v-if="!this.isFilter">
        <h1 class="text-3xl heading text-left mb-4">gfdgdf</h1>
        <ol id="games-list" class="h-full mb-16 mx-auto">
            <a
                v-for="newgame in this.newgames"
                :href="'/game/' + newgame.slug"
                class="w-80 h-48 bg-scnd-color rounded-md hover:text-tx-color hover:brightness-110 hover:scale-110 text-tx-color mb-14 mx-auto"
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
                    <span
                        class="ml-auto py-2.5 font-semibold"
                        v-if="newgame.original_price === 0"
                    >
                        Free
                    </span>
                    <span
                        class="ml-auto py-2.5 font-semibold"
                        v-if="newgame.is_sale === 1"
                    >
                        {{ newgame.sale_price + "€" }}
                    </span>
                    <span
                        class="ml-auto py-2.5 font-semibold"
                        v-if="newgame.is_sale === 0"
                    >
                        {{ newgame.original_price + "€" }}
                    </span>
                </div>
            </a>
        </ol>

        <h1 class="text-3xl heading text-left mb-4">gfdgdf</h1>
        <ol id="games-list" class="h-full mb-16 mx-auto">
            <a
                v-for="salegame in this.salegames"
                :href="'/game/' + salegame.slug"
                class="w-80 h-48 bg-scnd-color rounded-md hover:text-tx-color hover:brightness-110 hover:scale-110 text-tx-color mb-14 mx-auto"
            >
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
                        class="ml-auto py-2.5 font-semibold"
                        v-if="salegame.original_price === 0"
                    >
                        Free
                    </span>
                    <span
                        class="ml-auto py-2.5 font-semibold"
                        v-if="salegame.is_sale === 1"
                    >
                        {{ salegame.sale_price + "€" }}
                    </span>
                    <span
                        class="ml-auto py-2.5 font-semibold"
                        v-if="salegame.is_sale === 0"
                    >
                        {{ salegame.original_price + "€" }}
                    </span>
                </div>
            </a>
        </ol>

        <h1 class="text-3xl heading text-left mb-4">gfdgdf</h1>
        <ol id="games-list" class="h-full mb-16 mx-auto">
            <a
                v-for="allgame in this.allgames"
                :href="'/game/' + allgame.slug"
                class="w-80 h-48 bg-scnd-color rounded-md hover:text-tx-color hover:brightness-110 hover:scale-110 text-tx-color mb-14 mx-auto"
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
                    <span
                        class="ml-auto py-2.5 font-semibold"
                        v-if="allgame.original_price === 0"
                    >
                        Free
                    </span>
                    <span
                        class="ml-auto py-2.5 font-semibold"
                        v-else-if="allgame.is_sale === 1"
                    >
                        {{ allgame.sale_price + "€" }}
                    </span>
                    <span
                        class="ml-auto py-2.5 font-semibold"
                        v-else-if="allgame.is_sale === 0"
                    >
                        {{ allgame.original_price + "€" }}
                    </span>
                </div>
            </a>
        </ol>
    </div>
</template>

<script>
export default {
    props: ["genres", "newgames", "salegames", "allgames"],
    data() {
        return {
            genre: "",
            name: "",
            order: "",
            isFilter: false,
            foundGames: [],
        };
    },

    methods: {
        submit() {
            console.log(this.genre);
            console.log(this.name);
            console.log(this.order);

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
                    console.log(res.data);
                    this.foundGames = res.data;
                    this.isFilter = true;
                });
        },
        reset() {
            this.name = "";
            this.order = "";
            this.genre = "";
            this.isFilter = false;
        },
    },

    created() {
        console.log(this.newgames);
    },
    updated() {},
};
</script>

<style></style>
