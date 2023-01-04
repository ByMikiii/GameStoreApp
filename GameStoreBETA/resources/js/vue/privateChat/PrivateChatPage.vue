<template>
  <section id="private-chat" v-if="!this.noFriends" class='bg-bg-color relative border-2 w-2/3 rounded-sm flex mx-auto'>
    <div class="flex-grow">
      <h1 class='text-center text-2xl border-b p-1'>Friends <small>({{ this.friends.length }})</small></h1>

    <ul class='h-full'>
    <li  id='friend' class='border-b p-2' v-for="friend in friends" @click="changeCurrentUser(friend)">
      <span>{{friend.name}}</span>
    </li>
    </ul>

    </div>
    <div id="private-chat" class='w-3/4 flex flex-col border-l'>
      <h1 class='text-center text-2xl border-b p-1'> {{ this.currentUser.name }} - Chat</h1>
      
      <div ref="privateChat" class="h-full overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color">
    <private-chat-message v-for="message in messages" :auth="auth" :message="message"></private-chat-message>
      </div>

      <private-chat-composer v-on:messagesent="addPrivateMessage" :auth="auth" :currentUser="currentUser"></private-chat-composer>
    </div>
  </section>
  <h1 v-if="this.noFriends" class="text-5xl text-center mt-72 ">You have no friends. 🥲</h1>
</template>

<script>

export default {
  props: ['friends','auth','user'],
  data() {
    return {
      currentUser: '',
      noFriends: false,
      messages: []
    }
  },
  mounted() {
    if (this.friends == '') {
      this.noFriends = true;
    }
    if (this.user) {
      this.changeCurrentUser(this.user);
    } else this.changeCurrentUser(this.friends[0]);

    this.getMessages();
    
    
  },
  updated() {
    this.scrollToEnd();
  },
  methods: {
    changeCurrentUser(userr) {
      this.currentUser = userr;
      this.getMessages();
    },
    getMessages() {
      axios.get("/messages/" + this.currentUser.id).then(response => {
        this.messages = response.data;
      })
    },
    addPrivateMessage(message) {
      this.messages.push(message);
      axios.post('/messages', message).then(response => {
        console.log(response.data);
      });
    },
    scrollToEnd() {
      const elm = this.$refs.privateChat;
      if (elm) {
        this.$nextTick(() => {
          elm.scrollTop = elm.scrollHeight;
          this.scrollHeight = elm.scrollHeight;
        })
      }
    }
  }
}
</script>

<style>
#private-chat{
  height: 85vh;
}
#friend{
  min-height: 5rem;
  width: auto;
}
</style>