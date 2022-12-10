import './bootstrap';


import { createApp, VueElement } from 'vue';

import User from './vue/User.vue';

const app = createApp({})
app.component('user', User)
app.mount('#app')