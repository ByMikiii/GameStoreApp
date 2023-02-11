<template>
    <div
        class="chat-composer flex p-1 border rounded-sm mt-auto w-full relative"
    >
        <input
            type="text"
            placeholder="Type something..."
            class="bg-transparent flex-auto outline-none"
            v-model="messageText"
            @keyup.enter="sendMessage"
        />
        <button class="button is-success w-24" @click="sendMessage">
            Send
        </button>
    </div>
</template>

<script>
export default {
    props: ["auth"],
    data() {
        return {
            messageText: "",
        };
    },
    methods: {
        sendMessage() {
            if (this.messageText !== "") {
                this.$emit("globalmessagesent", {
                    message_text: this.messageText,
                    user: {
                        name: this.auth.name,
                    },
                });
                this.messageText = "";
            }
        },
    },
    created() {},
};
</script>

<style></style>
