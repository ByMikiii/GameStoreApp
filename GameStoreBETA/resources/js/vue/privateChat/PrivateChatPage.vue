<template>
    <section
        id="private-chat"
        v-if="!this.noFriends"
        class="bg-scnd-color w-5/6 relative rounded-md flex mx-auto"
    >
        <div class="flex-grow">
            <h1 class="text-center text-2xl p-1 heading">
                Friends <small>({{ this.friendlist.length }})</small>
            </h1>

            <ul class="h-full text-left">
                <li
                    id="friend"
                    class="p-2 cursor-pointer flex"
                    v-for="(friend, index) in friendlist"
                    :key="index"
                    @click="changeCurrentUser(friend)"
                    v-bind:class="
                        friend.name === this.currentUser.name
                            ? 'bg-yellow-400 text-black'
                            : null
                    "
                >
                    <img
                        class="ml-2 w-12 h-12 rounded-full mt-2"
                        :src="friend.profile_photo"
                        :alt="friend.name + ' profile photo'"
                    />
                    <div class="ml-4 mt-3">
                        <span class="truncate w-5/6">{{ friend.name }}</span>
                        <p class="truncate text-gray-400 text-xs w-52">
                            {{ friend.pivot.latest_message_text }}
                        </p>
                    </div>
                </li>
            </ul>
        </div>
        <div
            id="private-chat"
            class="w-3/4 flex flex-col border-l border-bg-color"
        >
            <h1 class="text-center text-2xl p-1 heading">
                {{ this.currentUser.name }}
            </h1>

            <div
                ref="privateChat"
                class="h-full overflow-x-hidden overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color p-4"
            >
                <private-chat-message
                    v-for="(message, index) in messages"
                    :key="index"
                    :auth="auth"
                    :message="message"
                ></private-chat-message>
            </div>

            <private-chat-composer
                v-on:messagesent="addPrivateMessage"
                :auth="auth"
                :currentUser="currentUser"
            ></private-chat-composer>
        </div>
    </section>
    <h1 v-if="this.noFriends" class="text-5xl text-center mt-72 heading">
        You have no friends. 🥲
    </h1>
</template>

<script>
import Echo from "laravel-echo";

export default {
    props: ["friends", "auth", "user"],
    data() {
        return {
            currentUser: "",
            noFriends: false,
            messages: [],
            friendlist: this.friends,
            latestMessage: "",
        };
    },
    mounted() {
        if (this.friends == "") {
            this.noFriends = true;
        }
        if (this.user) {
            this.changeCurrentUser(this.user);
        } else this.changeCurrentUser(this.friendlist[0]);

        this.getMessages();
    },
    updated() {
        this.scrollToEnd();
    },
    created() {
        let chatChannel = window.Echo.private("chat." + this.auth.id);
        chatChannel.listen("MessagePosted", (e) => {
            if (
                e.receiver.id == this.auth.id &&
                e.sender.id == this.currentUser.id
            ) {
                this.friendlist.forEach((friend) => {
                    if (friend.id == e.sender.id) {
                        friend.pivot.latest_message_text = e.message.text;
                    }
                });
                this.messages.push({
                    text: e.message.text,
                    id: e.message.id,
                    created_at: e.message.created_at,
                    updated_at: e.message.updated_at,
                    is_deleted: e.message.is_deleted,
                    was_seen: e.message.was_seen,
                    sender_id: e.message.sender_id,
                    receiver_id: e.message.receiver_id,
                    sender: e.sender,
                    receiver: e.receiver,
                });
            }
        });
    },
    methods: {
        changeCurrentUser(userr) {
            this.currentUser = userr;
            this.getMessages();
        },
        getMessages() {
            axios.get("/messages/" + this.currentUser.id).then((response) => {
                this.messages = response.data;
            });
        },
        addPrivateMessage(message) {
            this.messages.push(message);
            axios.post("/messages", message);

            this.friendlist.forEach((friend) => {
                if (friend.id == message.receiver_id) {
                    friend.pivot.latest_message_text = message.text;
                }
            });

            //LATEST MESSAGE ON INDEX 0
            let indexOfUser = this.friendlist.findIndex((object) => {
                return object.name === this.currentUser.name;
            });

            this.friendlist.splice(indexOfUser, 1);
            this.friendlist.unshift(this.currentUser);
        },
        scrollToEnd() {
            const elm = this.$refs.privateChat;
            if (elm) {
                this.$nextTick(() => {
                    elm.scrollTop = elm.scrollHeight;
                    this.scrollHeight = elm.scrollHeight;
                });
            }
        },
    },
};
</script>

<style>
#private-chat {
    height: 80vh;
}
#friend {
    min-height: 5rem;
    width: auto;
}
</style>
