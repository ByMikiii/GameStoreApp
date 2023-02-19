<template>
    <div
        class="chat-message border-b border-bg-color pb-2 px-4 hover:bg-gray-500 hover:bg-opacity-10"
        v-bind:class="
            message.user.name === this.auth.name ? 'text-right' : null
        "
    >
        <small class="text-red-500">{{ message.user.name }}</small>
        <p class="break-words">{{ message.message_text }}</p>
    </div>
</template>

<script>
export default {
    props: ["message", "auth"],
};
</script>

<style></style>
