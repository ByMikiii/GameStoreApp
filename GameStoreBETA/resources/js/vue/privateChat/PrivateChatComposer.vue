<template>
    <div
        class="chat-composer flex p-1 border rounded-sm mt-auto w-full relative"
    >
        <input
            type="text"
            placeholder="Type something..."
            class="bg-transparent flex-auto outline-none"
            v-model="privateMessageText"
            @keyup.enter="sendPrivateMessage"
        />
        <button class="button is-success w-24" @click="sendPrivateMessage">
            Send
        </button>
    </div>
</template>

<script>
export default {
    props: ["auth", "currentUser"],
    data() {
        return {
            privateMessageText: "",
        };
    },
    methods: {
        sendPrivateMessage() {
            if (this.privateMessageText !== "") {
                this.$emit("messagesent", {
                    sender_id: this.auth.id,
                    receiver_id: this.currentUser.id,
                    text: this.privateMessageText,
                    was_seen: 0,
                    is_deleted: 0,
                    sender: this.auth,
                    receiver: this.currentUser,
                });
                this.privateMessageText = "";
            }
        },
    },
};
</script>

<style></style>
