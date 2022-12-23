<script>
export default {
    data() {
        return {};
    },
    methods: {},
    mounted() {},
};
</script>

<template>
    <Transition name="bounce">
        <div class="notification is-success">
            <button class="delete" @click="hide"></button>
            <span>{{ this.text }}</span>
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
