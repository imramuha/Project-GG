<template>
    <router-link :to="{ name: 'profile', params: { id: friend.id } }">
        <div class="friendlist container">
            <img src="https://placekitten.com/250/250" />
            <p>{{ friend.username }}</p>
            <p>{{ friend.email }}</p>
            <p>{{ friend.status.name }}</p>
        </div>
    </router-link>
</template>

<script>
export default {
    name: "Friendlist",
    props: {
        friend: {
            type: Object,
            default: () => {
                return {};
            }
        }
    }
};
</script>

<style scoped>
.container {
    padding: 20px;
    margin: 20px auto;
    background-color: lightcyan;
    width: 250px;
    height: auto;
}

.friendlist img {
    width: 50px;
    height: 50px;
}
</style>
