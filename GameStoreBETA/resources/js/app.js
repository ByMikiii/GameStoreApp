import './bootstrap';

import { createApp, VueElement } from 'vue';

import User from './vue/User.vue';
import FlashMessage from './vue/FlashMessage.vue';

const app = createApp({})
app.component('flash-message', FlashMessage)
app.component('user', User)
app.mount('#app')