<template>
    <div class="flex">
        <a
            class="w-10 mt-auto mb-3 h-auto mr-2"
            v-if="this.message.receiver.name === this.auth.name"
            :href="'/user/' + this.message.sender.name"
        >
            <img
                class="rounded-full w-10 h-10"
                :src="this.message.sender.profile_photo"
                alt="Profile Photo"
            />
        </a>
        <div
            id="privateMessage"
            class="rounded-xl mb-3 text-left text-black px-2 py-1"
            v-bind:class="
                this.message.sender.name === this.auth.name
                    ? 'ml-auto text-left rounded-br-sm bg-yellow-400'
                    : 'rounded-bl-sm text-right bg-blue-300'
            "
        >
            <span class="my-auto">{{ this.message.text }}</span>
            <p
                class="text-xs text-gray-500"
                v-bind:class="
                    this.message.sender.name === this.auth.name
                        ? 'text-right'
                        : 'text-left'
                "
            >
                {{ this.messageTimeAgo }}
            </p>
        </div>
        <a
            class="w-10 mt-auto mb-3 h-auto ml-2"
            v-if="this.message.sender.name === this.auth.name"
            :href="'/user/' + this.message.sender.name"
        >
            <img
                class="rounded-full w-10 h-10"
                :src="this.message.sender.profile_photo"
                alt="Profile Photo"
            />
        </a>
    </div>
</template>

<script>
import dayjs from "dayjs";
var relativeTime = require("dayjs/plugin/relativeTime");
dayjs.extend(relativeTime);

export default {
    props: ["message", "auth"],
    methods: {
        convertTime() {
            this.messageTimeAgo = dayjs(this.message.created_at).fromNow();
        },
    },
    created() {
        this.convertTime();
        setInterval(() => {
            this.convertTime();
        }, 15000);
    },
    data() {
        return {
            messageTimeAgo: null,
        };
    },
};
</script>

<style>
#privateMessage {
    max-width: 240px;
}
</style>
