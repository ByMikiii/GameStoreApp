<template>
  <section class='bg-bg-color relative border-2 w-2/3 h-96 rounded-sm flex mx-auto'>
    <ol class='flex-grow'>
      <h1 class='text-center text-2xl w-full border-b p-1 pb-2'>Friends <small>({{ this.friends.length }})</small></h1>

    <li id='friend' class='h-20 border-b p-2' v-for="friend in friends">
      <span>{{friend.name}}</span>
    </li>
    
    </ol>
    <div id="private-chat" class='w-3/4 flex flex-col border-l'>
      <h1 class='text-center text-2xl w-full border-b p-1 pb-2'> {{ this.currentUser.name }} - Chat</h1>
      <private-chat-log></private-chat-log>
      <private-chat-composer></private-chat-composer>
    </div>
  </section>
</template>

<script>
export default {
  props: ['friends','auth','user'],
  data() {
    return {
      currentUser: ''
    }
  },
  mounted() {
    if (this.user) {
      this.currentUser = this.user;
    }
  }
}
</script>

<style>

</style>