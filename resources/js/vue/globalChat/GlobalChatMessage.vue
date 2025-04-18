<template>
    <div
        class="chat-message border-b border-bg-color pb-2 px-4 hover:bg-gray-500 hover:bg-opacity-10 text-left"
    >
        <small
            v-bind:class="
                message.user.name === this.auth.name
                    ? 'text-tx-color font-bold'
                    : 'text-red-600'
            "
            class="text-lg"
            >{{ message.user.name }}</small
        >
        <small class="ml-2 text-gray-400 relative bottom-0.5">{{
            this.time
        }}</small>
        <p class="break-words ml-2">{{ message.message_text }}</p>
    </div>
</template>

<script>
export default {
    props: ["message", "auth"],
    data() {
        return {
            time: "",
        };
    },
    created() {
        const isoDate = this.message.created_at;

        this.time = new Date(isoDate).toLocaleTimeString("it-IT", {
            hour: "2-digit",
            minute: "2-digit",
        });
        if (this.time == "Invalid Date") {
            this.time = new Date().toLocaleTimeString("it-IT", {
                hour: "2-digit",
                minute: "2-digit",
            });
        }
    },
};
</script>

<style></style>
