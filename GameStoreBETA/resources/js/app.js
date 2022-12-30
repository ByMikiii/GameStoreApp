import './bootstrap';

import { createApp, VueElement } from 'vue';

import Community from './vue/Community.vue';
import FlashMessage from './vue/FlashMessage.vue';
import Message from './vue/Message.vue';

const app = createApp({})
app.component('flash-message', FlashMessage)
app.component('community', Community)
app.component('message', Message)
app.mount('#app')