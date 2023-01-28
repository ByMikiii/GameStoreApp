<template>
    <Transition name="bounce">
        <div class="notification is-success bg-red-600" v-show="isShown">
            <button class="delete" @click="hide"></button>
            <span>{{ notification_text }}</span>
        </div>
    </Transition>
</template>

<script>
export default {
    props: ["auth"],
    data() {
        return { isShown: false, notification_text: "" };
    },

    methods: {
        show() {
            this.isShown = true;
            setTimeout(() => this.hide(), 3000);
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
            this.show();
        });
    },
    updated() {},
};
</script>

<style></style>
