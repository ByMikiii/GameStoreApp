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
        <small class="text-xs block m-0 mr-2 ml-2">{{
            this.message.sender.name
        }}</small>

        <span class="block m-0 mr-2 ml-2">{{ this.message.text }}</span>

        <small class="text-xs block m-0 mr-2 ml-2">{{
            convertTime(this.message.created_at)
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
        convertTime(time) {
            return dayjs(time).fromNow();
        },
    },
    created() {},
};
</script>

<style>
#privateMessage {
    max-width: 240px;
}
</style>
