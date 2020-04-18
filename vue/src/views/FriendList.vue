<template>
    <div>
        <p>List of my online friends</p>

        <FriendListCard v-for="friend in friends" :key="friend.id" :friend="friend"/>
    </div>
</template>

<script>
import FriendListCard from '@/components/FriendListCard.vue'

export default {
    components: {
        // child component
        FriendListCard
    },
    props: ['friends']
}
</script>
