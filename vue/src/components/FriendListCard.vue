<template>
    <div>
        <router-link :to="{name: 'profile', params: { id: friend.id } }">
        <h1>{{ friend.id }}</h1>
    
        <p>icon: {{ friend.icon}}</p>
       <p>name: {{ friend.name }}</p>
         <p>username: {{ friend.username }}</p>
             <BaseIcon name="users">
                <p slot="tagline">tagline: {{ friend.tagline }}</p>
                <p slot="status">status:  {{ friend.status }}</p>
             </BaseIcon>
        </router-link>
      
    </div>
</template>

<script>
export default {
  props: {
      friend: Object
  }
}
</script>

<style scoped>
p {
    color: green;
}    
</style>