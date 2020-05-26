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

import { postMessage } from "@/services/inbox.api";

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
        async sendMessage(text) {
            if(!this.friend) {
                return;
            }

            let userMessage = {
                text: text,
                friend_id: this.friend.id
            };

            console.log(userMessage);
            try {
                await postMessage(userMessage)
               .then((response) => {
                    this.$emit('new', response.data);
                });

            } catch (error) {
                console.log(error);
            }
        }
    }
}
</script>