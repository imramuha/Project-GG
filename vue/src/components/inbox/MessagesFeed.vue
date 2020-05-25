<template>
    <div class="messagesFeed">
        <ul v-if='friend'>
            <li v-for="message in messages" :class="`message${message.to == friend.id ? 'sent' : 'received' }`" :key="message.id">
                <div class="messageText"> {{ message.text }}</div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        friend: {
            type: Object,
        },
        messages: {
            type: Array,
            required: true
        }

    }
}
</script>