<script>
// TODO: Axios for all friendships,
// TODO: Add friend button VUE, community only button vue
export default {
    props: [],

    data() {
        return {
            friendStatus: 0,
        };
    },

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
