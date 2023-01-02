import './bootstrap';

import { createApp, VueElement } from 'vue';

import FlashMessage from './vue/FlashMessage.vue';
import Community from './vue/Community.vue';

import GlobalChatMessage from './vue/globalChat/GlobalChatMessage.vue';
import GlobalChatLog from './vue/globalChat/GlobalChatLog.vue';
import GlobalChatComposer from './vue/globalChat/GlobalChatComposer.vue';

import PrivateChatPage from './vue/privateChat/PrivateChatPage.vue';
import PrivateChatMessage from './vue/privateChat/PrivateChatMessage.vue';
import PrivateChatLog from './vue/privateChat/PrivateChatLog.vue';
import PrivateChatComposer from './vue/privateChat/PrivateChatComposer.vue';

import axios from 'axios';
import Echo from 'laravel-echo';


const app = createApp({
  data() {
    return {
      globalMessages: '',
    }
  },
  methods: {
    addMessage(message) {
      this.globalMessages.push(message);
      axios.post('/globalmessages', message);
    }
  },
  created() {
    if (document.getElementById('logged')) {
      axios.get('/globalmessages').then(response => {
        this.globalMessages = response.data;
      })

      let channel = window.Echo.channel('global-chat');
      // channel.here((users) => {
      //   console.log(users);
      // })
      // channel.joining(user => {
      //   this.usersInChat.push(user);
      // });
      // channel.leaving(user => {
      //   this.usersInChat = this.usersInChat.filter(u => u != user);
      // });
      channel.listen('GlobalMessagePosted', (e) => {
        this.globalMessages.push({
          message_text: e.message.message_text,
          user: e.user
        })
      })
    }
  }
})
app.component('flash-message', FlashMessage)
app.component('community', Community)
//GLOBAL MESSAGES
app.component('global-chat-message', GlobalChatMessage)
app.component('global-chat-log', GlobalChatLog)
app.component('global-chat-composer', GlobalChatComposer)

//PRIVATE MESSAGES
app.component('private-chat-message', PrivateChatMessage)
app.component('private-chat-log', PrivateChatLog)
app.component('private-chat-composer', PrivateChatComposer)
app.component('private-chat-page', PrivateChatPage)

app.mount('#app')


