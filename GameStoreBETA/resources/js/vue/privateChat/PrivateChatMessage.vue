<template>
<div id="privateMessage" class="bg-blue-500 p-1 h-12 rounded-md m-2" v-bind:class="this.message.sender.name === this.auth.name ? 'ml-auto text-right' : null">
  <small>{{ this.message.sender.name}}</small> 
  <br>
  <span>{{ this.message.text }}</span>
</div>
</template>

<script>
export default {
  props: ['message', 'auth'],
  created() {
    
  },
}
</script>

<style>
#privateMessage{
  
  max-width: 240px;
}
</style>