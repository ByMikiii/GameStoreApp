<template>
    <section
        id="private-chat"
        v-if="!this.noFriends"
        class="bg-bg-color relative border-2 rounded-sm flex mx-auto"
    >
        <div class="flex-grow">
            <h1 class="text-center text-2xl border-b p-1">
                Friends <small>({{ this.friendlist.length }})</small>
            </h1>

            <ul class="h-full">
                <li
                    id="friend"
                    class="border-b p-2 cursor-pointer"
                    v-for="(friend, index) in friendlist"
                    :key="index"
                    @click="changeCurrentUser(friend)"
                    v-bind:class="
                        friend.name === this.currentUser.name
                            ? 'bg-green-500'
                            : null
                    "
                >
                    <span>{{ friend.name }}</span>
                </li>
            </ul>
        </div>
        <div id="private-chat" class="w-3/4 flex flex-col border-l">
            <h1 class="text-center text-2xl border-b p-1">
                {{ this.currentUser.name }} - Chat
            </h1>

            <div
                ref="privateChat"
                class="h-full overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color"
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
    <h1 v-if="this.noFriends" class="text-5xl text-center mt-72">
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
    height: 85vh;
}
#friend {
    min-height: 5rem;
    width: auto;
}
</style>
