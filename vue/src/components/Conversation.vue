<template>
    <div class="conversation">
        <h1>Here comes the names of the person we're chatting with</h1>
        <MessagesFeed :friend="friend" :messages="messages" />
        <MessageComposer @send="sendMessage" />
    </div>
</template>

<script>
import MessagesFeed from "@/components/inbox/MessagesFeed";
import MessageComposer from "@/components/inbox/MessageComposer";

export default {
    components: { MessagesFeed, MessageComposer},
    props: {
        friend: {
            type: Object,
            default: null,
        },
        messages: {
            type: Array,
            //default: [],
        }
    },
    methods: {
        sendMessage(text) {
            console.log(text);
        }
    }
}
</script>