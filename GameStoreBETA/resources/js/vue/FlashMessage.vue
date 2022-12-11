<script>
export default {
    props: ["text"],

    data() {
        return {
            isShown: false,
        };
    },
    created() {
        if (this.text) {
            this.show();
        }
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
};
</script>

<template>
    <Transition name="bounce">
        <div class="notification is-success" v-show="isShown">
            <button class="delete" @click="hide"></button>
            <span>{{ text }}</span>
        </div>
    </Transition>
</template>

<style>
.notification,
.is-succes {
    font-size: small;
    position: fixed;
    right: 16px;
    bottom: 16px;
}
.bounce-enter-active {
    animation: bounce-in 0.5s;
}
.bounce-leave-active {
    animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.25);
    }
    100% {
        transform: scale(1);
    }
}
</style>
