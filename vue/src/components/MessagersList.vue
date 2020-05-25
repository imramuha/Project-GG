<template>
    <div class="messagersList">
        <ul  >
            <li v-for="(friend, index) in friends" :key="friend.id" @click="selectedFriend(index, friend)" :class="{ 'selected': index == selected}">
                <p>{{ friend.username }}</p>
            </li>
        
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        friends: {
            type: Array,
            defaults: []
        }
    },
    data () {
        return {
            selected: 0
        }
    },
    methods: {
        selectedFriend(index, friend) {
            this.selected = index;
            this.$emit('selected', friend);
        }
    }
}
</script>