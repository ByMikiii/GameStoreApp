<template>
<div class="chat-message" v-bind:class="message.user.name === this.auth.name ? 'text-right' : null">
  <small class="text-red-500">{{message.user.name}}</small>
  <p class="break-words">{{ message.message_text }}</p>
  
</div>
</template>

<script>
export default {
  props: ['message', 'auth'],
}
</script>

<style>

</style>