<template>
    <section
        id="private-chat"
        v-if="!this.noFriends"
        class="bg-scnd-color w-5/6 relative rounded-md flex mx-auto"
    >
        <div class="flex-grow">
            <h1 class="text-center text-2xl p-1 heading">
                {{ __("friends") }} ({{ this.friends.length }})
            </h1>

            <div class="flex mb-2 w-full">
                <input
                    class="bg-scnd-color border-b ml-4 pb-1 focus:outline-none w-full"
                    name="filter-name"
                    :placeholder="__('search')"
                    v-model="this.filterName"
                    @keyup.enter="this.filter"
                    type="text"
                />
                <svg
                    @click="this.filter"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                    class="w-4 fill-gray-500 relative right-5 hover:cursor-pointer"
                >
                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
                    />
                </svg>
            </div>

            <ul class="text-left">
                <li
                    id="friend"
                    class="p-2 cursor-pointer flex hover:brightness-125 hover:bg-gray-500 hover:bg-opacity-5 font-semibold"
                    v-for="(friend, index) in friendlist"
                    :key="index"
                    @click="changeCurrentUser(friend)"
                    v-bind:class="
                        friend.name === this.currentUser.name
                            ? 'bg-yellow-400 text-black hover:brightness-105 hover:bg-yellow-400 hover:bg-opacity-100'
                            : 'text-yellow-400 '
                    "
                >
                    <img
                        class="ml-2 w-12 h-12 rounded-full mt-2"
                        :src="friend.profile_photo"
                        :alt="friend.name + ' profile photo'"
                    />
                    <div class="ml-4 mt-3">
                        <span class="truncate w-5/6">{{ friend.name }}</span>
                        <p class="truncate text-gray-400 text-xs w-48">
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
                :lang="this.lang"
            ></private-chat-composer>
        </div>
    </section>
    <h1 v-if="this.noFriends" class="text-5xl text-center mt-72 heading">
        Nemáte žiadnych priateľov. 🥲
    </h1>
</template>

<script>
import Echo from "laravel-echo";

export default {
    props: ["friends", "auth", "user", "lang"],
    data() {
        return {
            currentUser: "",
            noFriends: false,
            messages: [],
            friendlist: this.friends,
            latestMessage: "",
            filterName: "",
            latestFilter: "",
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
        if (this.latestFilter !== this.filterName) {
            this.filter();
        }
    },
    created() {
        this.$lang().setLocale(this.lang);

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
        filter() {
            this.friendlist = this.friends.filter((e) =>
                e.name.toLowerCase().includes(this.filterName.toLowerCase())
            );
            if (this.friendlist.length > 0) {
                this.changeCurrentUser(this.friendlist[0]);
            }
            this.latestFilter = this.filterName;
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

            //this.friendlist.splice(indexOfUser, 1);
            //this.friendlist.unshift(this.currentUser);
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
