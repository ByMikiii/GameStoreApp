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
            friendStatus: 0,
        };
    },
    //Friend status 0 - Not friends
    //              1 - Friends
    //              2 - Pending To
    //              3 - Pending From
    methods: {
        addFriend() {
            axios.post("/friends/create/" + this.userData.id);
            this.friendStatus = 2;
        },

        removeFriend() {
            axios.delete("/friends/delete/" + this.userData.id);
            this.friendStatus = 0;
        },

        acceptFriend() {
            axios.patch("/friends/update/" + this.userData.id);
            this.friendStatus = 1;
        },

        checkStatus() {
            this.friends.forEach((friendId) => {
                if (friendId == this.userData.id) {
                    this.friendStatus = 1;
                }
            });

            this.pendingFriendsTo.forEach((pendingFriendToId) => {
                if (pendingFriendToId == this.userData.id) {
                    this.friendStatus = 2;
                }
            });

            this.pendingFriendsFrom.forEach((pendingFriendFromId) => {
                if (pendingFriendFromId == this.userData.id) {
                    this.friendStatus = 3;
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
    <div class="h-20 grid text-black">
        <a :href="'/user/' + userData.name" class="flex">
            <img
                :src="userData.profile_photo"
                alt="Profile Picture"
                class="w-12 mr-3"
            />
            <p class="text-red-500 mt-2">{{ userData.name }}</p>
            <strong
                class="text-white mt-2"
                v-if="(userData.id == authUser) & (authUser !== 0)"
            >
                &nbsp;&nbsp;(YOU)</strong
            >
        </a>
        <div class="h-full ml-auto">
            <a
                class="mybutton bg-green-500"
                @click="addFriend"
                v-if="
                    (userData.id !== authUser) &
                    (authUser !== 0) &
                    (this.friendStatus == 0)
                "
                >Add Friend</a
            >
            <div
                v-if="
                    (userData.id !== authUser) &
                    (authUser !== 0) &
                    (this.friendStatus == 1)
                "
            >
                <a class="mybutton bg-green-500 mr-2" @click="removeFriend"
                    >Remove Friend</a
                >
                <a class="mybutton bg-blue-500" :href="'/chat/' + userData.name"
                    >Chat</a
                >
            </div>
            <a
                class="mybutton bg-green-500"
                @click="removeFriend"
                v-if="
                    (userData.id !== authUser) &
                    (authUser !== 0) &
                    (this.friendStatus == 2)
                "
                >Request Pending</a
            >
            <div
                v-if="
                    (userData.id !== authUser) &
                    (authUser !== 0) &
                    (this.friendStatus == 3)
                "
            >
                <a @click="acceptFriend" class="mybutton bg-green-500 mr-2"
                    >Accept</a
                >
                <a @click="removeFriend" class="mybutton bg-red-500">Decline</a>
            </div>
        </div>
    </div>
</template>
