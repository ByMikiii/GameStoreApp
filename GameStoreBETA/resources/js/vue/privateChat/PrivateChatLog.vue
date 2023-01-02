<template>
  <div ref="privateChat" class="overflow-hidden">
    <private-chat-message v-for="message in messages" :message="message" :auth="auth">  </private-chat-message>
  </div>
</template>
<script>
export default {
  props: ["messages", "auth"],
  methods: {
    scrollToEnd() {
      const elm = this.$refs.privateChat;
      if (elm) {
        this.$nextTick(() => {
          elm.scrollTop = elm.scrollHeight;
          this.scrollHeight = elm.scrollHeight;
        })
      }
    }
  },
  updated() {
    this.scrollToEnd();
   }
}


</script>

<style>

</style>