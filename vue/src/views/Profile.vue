<template>
    <div>
<p>This is user X's profile {{ id }}{{ friend.id }}{{ friend.username }}</p>
        <button>hi</button>
        <p>{{ relation.name }}</p>
        <ul>
            <li>User X</li>
            <li>User X facepic :)</li>
        </ul>
    </div>
</template>

<script>
import UserService from "@/services/UserService.js";
export default {
    props: ["id"],
    data() {
        return {
            friend: [],
            relation: []
        };
    },
    created() {
        UserService.getFriend(this.id)
            .then(response => {
                this.friend = response.data.user[0];
                this.relation = response.data.relation[0];
                // console.log(JSON.parse(JSON.stringify(this.friend[0])));
            })
            .catch(error => {
                console.log("there was an error:", error.reponse);
            });
    }
};
</script>

<style></style>
