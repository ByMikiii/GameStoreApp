import './bootstrap';

import MultiVue from 'vue-multivue';
import { createApp, VueElement } from 'vue';

import AddFriend from './vue/add-friend.vue';


new MultiVue('#add-friend', {
  components: {
    AddFriend
  }
});
