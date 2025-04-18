<template>
    <Transition name="bounce">
        <div
            class="notification bg-scnd-color border-2 border-bg-color"
            v-if="this.isShown"
        >
            <button class="delete" @click="hide"></button>
            <span class="text-tx-color text-lg">{{ notification_text }}</span>
        </div>
    </Transition>
</template>

<script>
export default {
    props: ["auth"],
    data() {
        return {
            isShown: false,
            notification_text: "",
            notification_color: "",
        };
    },

    methods: {
        show() {
            this.isShown = true;
            setTimeout(() => this.hide(), 5000);
        },

        hide() {
            this.isShown = false;
        },
    },

    created() {
        let notificationChannel = window.Echo.private(
            "notification." + this.auth.id
        );
        notificationChannel.listen("NotificationSent", (e) => {
            this.notification_text = e.text;
            this.notification_color = e.color;
            this.show();
        });
    },
    updated() {},
};
</script>

<style></style>
