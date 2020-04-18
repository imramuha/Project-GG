<template>
    <div>
        <p>This is the WAITING ROOM/dashboard/home</p>
        <ul>
            <li>friendlist</li>
            <li>minifeed</li>
        </ul>
        <FriendList v-bind:friends="friends"/>
    </div>
</template>

<script>
import FriendList from '@/views/FriendList.vue'
import UserService from '@/services/UserService.js'

export default {
    components: {
        // child component
        FriendList
    },
    data () {
        return {
            friends: []
        }
    },
    created () {
        UserService.getFriends().then(response => {
            this.friends = response.data;
        })
        .catch (error => {
            console.log(error.response);
        })
    }
}
</script>