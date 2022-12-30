<script>
export default {
    props: ["message","authUser"],

    data() {
        return {
        };
    },
    created() {
        console.log('yez')
    },
    methods: {

    },
};
</script>

<template>
<p :style="[ this.message.sender.id === this.authUser ?  'background-color: red' : 'background-color: yellow' ]">{{this.message.sender.name+': '+this.message.message_text}}</p>
</template>

<style>

</style>
