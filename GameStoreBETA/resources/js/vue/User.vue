<script>
import FlashMessageVue from "./FlashMessage.vue";

export default {
    props: ["userData", "authUser"],
    data() {
        return {};
    },

    methods: {
        addFriend() {
            axios
                .post("/friends/create/" + this.userData.id)
                .then((response) => {
                    console.log(response.data.message);
                });
        },
    },

    mounted() {
        console.log("het");
    },
};
</script>

<template>
    <li class="">
        <p class="text-red-500">{{ userData.name }}</p>
        <a class="mr-5" :href="'/user/' + userData.name">View Profile</a>

        <a
            class="cursor-pointer"
            @click="addFriend"
            v-if="(userData.id !== authUser) & (authUser !== 0)"
            >Add Friend</a
        >
    </li>
</template>
