import "./bootstrap";

import { createApp, VueElement } from "vue";

import AddFriend from "./vue/AddFriend.vue";

import Basket from "./vue/Basket.vue";

import GamePage from "./vue/GamePage.vue";

import FlashMessage from "./vue/FlashMessage.vue";

import GlobalChatComposer from "./vue/globalChat/GlobalChatComposer.vue";
import GlobalChatLog from "./vue/globalChat/GlobalChatLog.vue";
import GlobalChatMessage from "./vue/globalChat/GlobalChatMessage.vue";

import PrivateChatComposer from "./vue/privateChat/PrivateChatComposer.vue";
import PrivateChatMessage from "./vue/privateChat/PrivateChatMessage.vue";
import PrivateChatPage from "./vue/privateChat/PrivateChatPage.vue";

import Payment from "./vue/Payment.vue";

import axios from "axios";
import Echo from "laravel-echo";

const app = createApp({
    data() {
        return {
            globalMessages: "",
        };
    },
    methods: {
        addMessage(message) {
            this.globalMessages.push(message);
            axios.post("/globalmessages", message);
        },
    },
    created() {
        if (document.getElementById("logged")) {
            axios.get("/globalmessages").then((response) => {
                this.globalMessages = response.data;
            });

            let channel = window.Echo.channel("global-chat");
            channel.listen("GlobalMessagePosted", (e) => {
                this.globalMessages.push({
                    message_text: e.message.message_text,
                    user: e.user,
                });
            });
        }
    },
});

//BASKET
app.component("basket", Basket);

//FLASH MESSAGES
app.component("flash-message", FlashMessage);

//ADD FRIEND BUTTON
app.component("addfriend", AddFriend);

//GLOBAL MESSAGES
app.component("global-chat-message", GlobalChatMessage);
app.component("global-chat-log", GlobalChatLog);
app.component("global-chat-composer", GlobalChatComposer);

//PRIVATE MESSAGES
app.component("private-chat-message", PrivateChatMessage);
app.component("private-chat-composer", PrivateChatComposer);
app.component("private-chat-page", PrivateChatPage);

//PAYMENT
app.component("payment", Payment);

//GAME
app.component("gamepage", GamePage);

app.mount("#app");
