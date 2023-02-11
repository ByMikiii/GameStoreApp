import "./bootstrap";

import { createApp, VueElement } from "vue";

import AddFriend from "./vue/AddFriend.vue";

import Basket from "./vue/Basket.vue";

import GamePage from "./vue/GamePage.vue";

import FlashMessage from "./vue/FlashMessage.vue";

import Library from "./vue/Library.vue";

import Reviews from "./vue/Reviews.vue";

import Notification from "./vue/Notification.vue";

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
        let pagePath = window.location.pathname;
        if (pagePath.includes("community")) {
            document.getElementById("community").style.color = "white";
        } else if (pagePath.includes("library")) {
            document.getElementById("library").style.color = "white";
        } else if (pagePath.includes("friends")) {
            document.getElementById("friends").style.color = "white";
        } else if (pagePath.includes("profile")) {
            document.getElementById("profile").style.color = "white";
        } else if (pagePath.includes("balance")) {
            document.getElementById("balance").style.color = "white";
        } else if (pagePath.includes("basket")) {
            document.getElementById("basket").style.fill = "white";
        } else if (pagePath.includes("login")) {
            document.getElementById("login").style.color = "white";
        } else if (pagePath.includes("register")) {
            document.getElementById("register").style.color = "white";
        } else {
            document.getElementById("market").style.color = "white";
        }
    },
});

//BASKET
app.component("basket", Basket);

//FLASH MESSAGES
app.component("flash-message", FlashMessage);

//NOTIFICATIONS
app.component("notification", Notification);

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

//LIBRARY
app.component("library", Library);

//REVIEWS
app.component("reviews", Reviews);

app.mount("#app");
