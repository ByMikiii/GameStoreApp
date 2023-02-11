<template>
    <a
        class="mt-auto mybutton bg-green-500 ml-auto"
        @click="addFriend"
        v-if="this.friendStatus == 0"
        >Add Friend</a
    >

    <div class="ml-auto mt-auto" v-if="this.friendStatus == 1">
        <a class="mybutton bg-blue-500 mr-2" :href="'/chat/' + this.user.name"
            >Chat</a
        >
        <a class="mybutton bg-green-500" @click="removeFriend">Remove Friend</a>
    </div>

    <a
        class="mt-auto mybutton bg-green-500 w-40 ml-auto"
        @click="removeFriend"
        v-if="this.friendStatus == 2"
        >Request Pending</a
    >

    <div class="mt-auto ml-auto" v-if="this.friendStatus == 3">
        <a @click="removeFriend" class="mybutton bg-red-500 mr-2">Decline</a>
        <a @click="acceptFriend" class="mybutton bg-green-500">Accept</a>
    </div>
</template>
<script>
export default {
    props: ["user", "friends", "pendingFriendsTo", "pendingFriendsFrom"],

    data() {
        return {
            friendStatus: 0,
        };
    },

    methods: {
        //Friend status 0 - Not friends
        //              1 - Friends
        //              2 - Pending To
        //              3 - Pending From

        addFriend() {
            axios.post("/friends/create/" + this.user.id);
            this.friendStatus = 2;
        },

        removeFriend() {
            axios.delete("/friends/delete/" + this.user.id);
            this.friendStatus = 0;
        },

        acceptFriend() {
            axios.patch("/friends/update/" + this.user.id);
            this.friendStatus = 1;
        },

        checkStatus() {
            this.friends.forEach((friendId) => {
                if (friendId == this.user.id) {
                    this.friendStatus = 1;
                }
            });

            this.pendingFriendsTo.forEach((pendingFriendToId) => {
                if (pendingFriendToId == this.user.id) {
                    this.friendStatus = 2;
                }
            });

            this.pendingFriendsFrom.forEach((pendingFriendFromId) => {
                if (pendingFriendFromId == this.user.id) {
                    this.friendStatus = 3;
                }
            });
        },
    },

    created() {
        this.checkStatus();
    },
};
</script>
