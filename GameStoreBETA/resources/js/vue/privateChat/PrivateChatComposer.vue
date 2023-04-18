<template>
    <div class="chat-composer flex rounded-md mt-auto w-full relative">
        <input
            type="text"
            maxlength="255"
            placeholder="Napíšte niečo..."
            class="bg-transparent flex-auto outline-none p-2"
            v-model="privateMessageText"
            @keyup.enter="sendPrivateMessage"
        />
        <button
            class="rounded-none rounded-br-md w-8 h-8 pr-2 mr-2 pt-1 fill-gray-400 hover:fill-white"
            @click="sendPrivateMessage"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M16.1 260.2c-22.6 12.9-20.5 47.3 3.6 57.3L160 376V479.3c0 18.1 14.6 32.7 32.7 32.7c9.7 0 18.9-4.3 25.1-11.8l62-74.3 123.9 51.6c18.9 7.9 40.8-4.5 43.9-24.7l64-416c1.9-12.1-3.4-24.3-13.5-31.2s-23.3-7.5-34-1.4l-448 256zm52.1 25.5L409.7 90.6 190.1 336l1.2 1L68.2 285.7zM403.3 425.4L236.7 355.9 450.8 116.6 403.3 425.4z"
                />
            </svg>
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
