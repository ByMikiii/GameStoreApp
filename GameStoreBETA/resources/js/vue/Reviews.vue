<template>
    <h1 class="text-3xl heading text-left mt-8 mb-4" v-if="this.game != 0">
        {{ __("reviews") }} ({{ this.gamereviews.length }}) - {{ this.rating }}%
    </h1>

    <ol class="w-full px-4 mb-20">
        <li
            class="bg-scnd-color rounded-md mb-5 p-4 text-left relative hover:brightness-105"
            v-if="!this.already_reviewed && this.auth && this.owngame === 1"
        >
            <div class="flex">
                <textarea
                    class="w-4/5 mr-5 h-20 bg-scnd-color focus:outline-none brightness-90 py-2 px-3 rounded-md"
                    v-model="currentreview"
                    :placeholder="__('reviewtext')"
                    cols="30"
                    rows="10"
                    maxlength="510"
                ></textarea>
                <div class="mx-auto">
                    <p class="text-left mb-2">{{ __("recommend") }}</p>

                    <button
                        class="bg-bg-color py-2 px-4 mr-4 ml-auto rounded-md transition-all hover:brightness-110 hover:scale-105"
                        @click="postReview(1)"
                    >
                        {{ __("yes") }}
                    </button>
                    <button
                        class="bg-bg-color py-2 px-4 mr-auto rounded-md transition-all hover:brightness-110 hover:scale-105"
                        @click="postReview(2)"
                    >
                        {{ __("no") }}
                    </button>
                </div>
            </div>
        </li>

        <li
            class="bg-scnd-color rounded-md mb-5 p-4 text-left relative hover:brightness-105"
            v-for="(review, index) in this.gamereviews"
            v-bind:class="review.positive_review === 1 ? '' : ''"
        >
            <div class="flex">
                <a
                    v-if="this.game != 0"
                    :href="'/user/' + review.user.name"
                    class="text-lg text-tx-color hover:brightness-110 hover:text-tx-color"
                    >{{ review.user.name }}</a
                >

                <a
                    v-if="this.game == 0"
                    :href="'/game/' + review.game.slug"
                    class="text-lg hover:text-yellow-400"
                    >{{ review.game.name }}</a
                >

                <svg
                    class="w-6 ml-2 mr-auto fill-red-600"
                    xmlns="http://www.w3.org/2000/svg"
                    v-if="review.positive_review !== 1"
                    viewBox="0 0 512 512"
                >
                    <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M323.8 477.2c-38.2 10.9-78.1-11.2-89-49.4l-5.7-20c-3.7-13-10.4-25-19.5-35l-51.3-56.4c-8.9-9.8-8.2-25 1.6-33.9s25-8.2 33.9 1.6l51.3 56.4c14.1 15.5 24.4 34 30.1 54.1l5.7 20c3.6 12.7 16.9 20.1 29.7 16.5s20.1-16.9 16.5-29.7l-5.7-20c-5.7-19.9-14.7-38.7-26.6-55.5c-5.2-7.3-5.8-16.9-1.7-24.9s12.3-13 21.3-13L448 288c8.8 0 16-7.2 16-16c0-6.8-4.3-12.7-10.4-15c-7.4-2.8-13-9-14.9-16.7s.1-15.8 5.3-21.7c2.5-2.8 4-6.5 4-10.6c0-7.8-5.6-14.3-13-15.7c-8.2-1.6-15.1-7.3-18-15.2s-1.6-16.7 3.6-23.3c2.1-2.7 3.4-6.1 3.4-9.9c0-6.7-4.2-12.6-10.2-14.9c-11.5-4.5-17.7-16.9-14.4-28.8c.4-1.3 .6-2.8 .6-4.3c0-8.8-7.2-16-16-16H286.5c-12.6 0-25 3.7-35.5 10.7l-61.7 41.1c-11 7.4-25.9 4.4-33.3-6.7s-4.4-25.9 6.7-33.3l61.7-41.1c18.4-12.3 40-18.8 62.1-18.8H384c34.7 0 62.9 27.6 64 62c14.6 11.7 24 29.7 24 50c0 4.5-.5 8.8-1.3 13c15.4 11.7 25.3 30.2 25.3 51c0 6.5-1 12.8-2.8 18.7C504.8 238.3 512 254.3 512 272c0 35.3-28.6 64-64 64l-92.3 0c4.7 10.4 8.7 21.2 11.8 32.2l5.7 20c10.9 38.2-11.2 78.1-49.4 89zM32 384c-17.7 0-32-14.3-32-32V128c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H32z"
                    />
                </svg>

                <svg
                    class="w-6 ml-2 mb-1 mr-auto fill-green-500"
                    xmlns="http://www.w3.org/2000/svg"
                    v-if="review.positive_review === 1"
                    viewBox="0 0 512 512"
                >
                    <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.2s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z"
                    />
                </svg>

                <svg
                    v-if="review.user.id === this.auth.id && this.game != 0"
                    class="w-4 fill-red-400 hover:fill-red-600 cursor-pointer absolute top-2 right-3"
                    @click="removeReview(review)"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 320 512"
                >
                    <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"
                    />
                </svg>
            </div>

            <div class="ml-2">
                <span class="text-gray-100 text-left">{{
                    review.review_text
                }}</span>
                <small class="text-gray-300 absolute bottom-0.5 right-2">{{
                    this.changeTimestamp(review.created_at)
                }}</small>
            </div>
        </li>
    </ol>
</template>

<script>
import { assertExpressionStatement } from "@babel/types";
import dayjs from "dayjs";
var relativeTime = require("dayjs/plugin/relativeTime");
dayjs.extend(relativeTime);

export default {
    props: ["reviews", "auth", "game", "owngame", "lang"],
    data() {
        return {
            gamereviews: this.reviews,
            currentreview: "",
            currentispositive: null,
            rating: 0,
            already_reviewed: false,
            your_review: null,
        };
    },
    methods: {
        postReview(recommended) {
            const newReview = {
                review_text: this.currentreview,
                positive_review: recommended,
                user: this.auth,
                game_id: this.game.id,
                created_at: dayjs().format(),
            };

            this.gamereviews.push(newReview);
            this.updateRating();

            axios.post("/addReview", newReview);
        },
        updateRating() {
            let positivereview = 0;

            this.gamereviews.forEach((r) => {
                if (r.positive_review === 1) {
                    positivereview++;
                }
                if (r.user.id === this.auth.id) {
                    this.already_reviewed = true;
                    this.your_review = r;
                }
            });

            if (this.gamereviews.length !== 0) {
                this.rating = Math.round(
                    (100 * positivereview) / this.gamereviews.length
                );
            }

            // YOUR REVIEW FIRST
            let indexOfReview = this.gamereviews.findIndex((object) => {
                return object.user.id === this.auth.id;
            });

            if (indexOfReview !== -1) {
                this.gamereviews.splice(indexOfReview, 1);
                this.gamereviews.unshift(this.your_review);
            }
        },
        removeReview(review) {
            this.gamereviews.splice(this.gamereviews.indexOf(review), 1);
            if (this.game != 0) {
                this.updateRating();
                axios.delete("/deleteReview/" + this.your_review.game_id);
            }

            this.already_reviewed = false;
            this.your_review = null;
        },
        changeTimestamp(timestamp) {
            return dayjs(timestamp).format("DD/MM/YYYY");
        },
    },
    created() {
        this.$lang().setLocale(this.lang);
        if (this.game != 0) {
            this.updateRating();
        }
    },
};
</script>

<style></style>
