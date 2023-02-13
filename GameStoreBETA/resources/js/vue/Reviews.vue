<template>
    <h1 class="text-3xl heading text-left mt-8 mb-4">Hodnotenia (50%)</h1>

    <ol class="w-full px-4">
        <li class="bg-scnd-color rounded-md mb-5 p-4 text-left">
            <textarea
                class="w-4/5 h-20 bg-scnd-color"
                v-model="currentreview"
                placeholder="Type your review..."
                cols="30"
                rows="10"
            ></textarea>
        </li>

        <li
            class="bg-scnd-color rounded-md mb-5 p-4 text-left"
            v-for="(review, index) in this.gamereviews"
            v-bind:class="
                review.positive_review === 1 ? 'bg-green-500' : 'bg-red-500'
            "
        >
            <a :href="'/user/' + review.user.name" class="text-lg">{{
                review.user.name
            }}</a>
            <br />
            <div class="ml-2">
                <span class="text-black text-left">{{
                    review.review_text
                }}</span>
            </div>
        </li>
    </ol>
</template>

<script>
export default {
    props: ["reviews", "authid", "game"],
    data() {
        return {
            gamereviews: this.reviews,
            currentreview: "",
            currentispositive: null,
        };
    },
    methods: {
        getReviews(gameid) {
            axios.get("getReviews/" + gameid).then((response) => {
                this.gamereviews = response.data;
            });
        },
        postReview() {
            this.reviews.push({
                review_text: this.currentreview,
            });
        },
        updated() {},
        created() {
            //this.getReviews(game.id);
        },
    },
};
</script>

<style></style>
