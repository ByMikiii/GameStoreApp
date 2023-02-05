<template>
    <Transition name="bounce">
        <div
            class="notification"
            v-bind:class="
                this.notification_color !== ''
                    ? 'bg-' + this.notification_color + '-400'
                    : 'bg-blue-400'
            "
            v-if="this.isShown"
        >
            <button class="delete" @click="hide"></button>
            <span>{{ notification_text }}</span>
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
            this.notification_color = e.color;
            this.show();
        });
    },
    updated() {},
};
</script>

<style></style>
