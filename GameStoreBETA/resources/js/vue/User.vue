<script>
export default {
    props: [
        "userData",
        "authUser",
        "friends",
        "pendingFriendsTo",
        "pendingFriendsFrom",
    ],
    data() {
        return {
            friendButton: "Add Friend",
            isPending: false,
        };
    },

    methods: {
        addFriend() {
            axios
                .post("/friends/create/" + this.userData.id)
                .then((response) => {
                    this.friendButton = response.data.message;
                });
        },
        acceptFriend() {
            this.friendButton = "Remove Friend";
            this.isPending = false;
        },
        declineFriend() {
            this.isPending = false;
        },
        checkStatus() {
            this.friends.forEach((friendId) => {
                if (friendId == this.userData.id) {
                    this.friendButton = "Remove Friend";
                }
            });

            this.pendingFriendsTo.forEach((pendingFriendToId) => {
                if (pendingFriendToId == this.userData.id) {
                    this.friendButton = "Request Pending";
                }
            });

            this.pendingFriendsFrom.forEach((pendingFriendFromId) => {
                if (pendingFriendFromId == this.userData.id) {
                    this.isPending = true;
                }
            });
        },
    },

    mounted() {
        this.checkStatus();
    },
};
</script>

<template>
    <li class="h-20 grid">
        <div class="flex">
            <img
                :src="userData.profile_photo"
                alt="Profile Picture"
                class="w-12 mr-3"
            />
            <p class="text-red-500 mt-auto mb-5">{{ userData.name }}</p>
        </div>
        <div class="h-full ml-auto">
            <a class="mybutton mr-2" :href="'/user/' + userData.name">
                View Profile
            </a>

            <a
                class="mybutton bg-green-500"
                @click="addFriend"
                v-if="
                    (userData.id !== authUser) &
                    (authUser !== 0) &
                    !this.isPending
                "
                >{{ this.friendButton }}</a
            >
            <div class="flex" v-if="this.isPending">
                <a @click="acceptFriend" class="mybutton bg-green-500"
                    >Accept</a
                >
                <a @click="declineFriend" class="mybutton bg-red-500"
                    >Decline</a
                >
            </div>
        </div>
    </li>
</template>
