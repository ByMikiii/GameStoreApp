<template>
  <div ref="globalChat" class="overflow-scroll">
    <global-chat-message v-for="message in messages" :message="message" :auth="auth">  </global-chat-message>
  </div>
</template>
<script>
export default {
  props: ["messages", "auth"],
  methods: {
    scrollToEnd() {
      const elm = this.$refs.globalChat;
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