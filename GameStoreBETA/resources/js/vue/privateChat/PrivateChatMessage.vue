<template>
    <div
        id="privateMessage"
        class="bg-blue-500 rounded-xl mr-2 mb-2"
        v-bind:class="
            this.message.sender.name === this.auth.name
                ? 'ml-auto text-right'
                : null
        "
    >
        <a
            class="text-xs block m-0 mr-2 ml-2"
            :href="'user/' + this.message.sender.name"
        >
            {{ this.message.sender.name }}
        </a>

        <span class="block m-0 mr-2 ml-2">{{ this.message.text }}</span>

        <small class="text-xs block m-0 mr-2 ml-2">{{
            this.messageTimeAgo
        }}</small>
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
