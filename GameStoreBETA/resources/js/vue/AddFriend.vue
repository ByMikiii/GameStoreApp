<template>
    <a
        class="mt-auto mybutton bg-tx-color text-black ml-auto px-2 py-1"
        @click="addFriend"
        v-if="this.friendStatus == 0"
        >{{ __("addfriend") }}</a
    >

    <div class="ml-auto mt-auto" v-if="this.friendStatus == 1">
        <a
            class="mybutton bg-blue-400 text-black mr-2 px-2 py-1"
            :href="'/chat/' + this.user.name"
            >Chat</a
        >
        <a
            class="mybutton bg-tx-color px-2 py-1 text-black"
            @click="removeFriend"
            >{{ __("unfriend") }}</a
        >
    </div>

    <a
        class="mt-auto mybutton bg-tx-color px-2 py-1 text-black w-40 ml-auto"
        @click="removeFriend"
        v-if="this.friendStatus == 2"
        >{{ __("requestsent") }}</a
    >

    <div class="mt-auto ml-auto" v-if="this.friendStatus == 3">
        <a
            @click="removeFriend"
            class="mybutton bg-red-500 px-2 py-1 mr-2 text-black"
            >{{ __("decline") }}</a
        >
        <a
            @click="acceptFriend"
            class="mybutton bg-tx-color px-2 py-1 text-black"
            >{{ __("accept") }}</a
        >
    </div>

    <div class="ml-auto mt-auto" v-if="this.friendStatus == 4">
        <a
            class="mybutton bg-blue-500 mr-2 px-2 py-1 w-14"
            :href="'/user/' + this.user.name"
            >{{ __("viewprofile") }}</a
        >
    </div>
</template>
<script>
export default {
    props: [
        "user",
        "friends",
        "pendingFriendsTo",
        "pendingFriendsFrom",
        "isauth",
        "lang",
    ],

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
        //              4 - Pending From

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
            if (this.isauth == "1") {
                if (this.friends != 0) {
                    this.friends.forEach((friendId) => {
                        if (friendId == this.user.id) {
                            this.friendStatus = 1;
                        }
                    });
                }
                if (this.pendingFriendsTo != 0) {
                    this.pendingFriendsTo.forEach((pendingFriendToId) => {
                        if (pendingFriendToId == this.user.id) {
                            this.friendStatus = 2;
                        }
                    });
                }
                if (this.pendingFriendsFrom != 0) {
                    this.pendingFriendsFrom.forEach((pendingFriendFromId) => {
                        if (pendingFriendFromId == this.user.id) {
                            this.friendStatus = 3;
                        }
                    });
                }
            } else {
                this.friendStatus = 4;
            }
        },
    },

    created() {
        //this.$lang().setLocale(this.lang);
        this.checkStatus();
        //console.log(this.lang);
    },
};
</script>
