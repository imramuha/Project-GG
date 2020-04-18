<template>
    <nav>
        <ul>
            <li>
                <router-link :to="{
                    name: ''
                }">Home</router-link>
            </li>
            <template v-if="authenticated">
                <li>{{ user.name }} {{ user.email }}</li>
                <li>
                    <router-link :to="{name: 'waiting-room' }">Waiting Room</router-link>
                </li>
                <li>
                    <router-link
                        :to="{
                        name: 'dashboard'
                    }"
                    >Dashboard</router-link>
                </li>
                <li>
                    <a href="#" @click.prevent="logout">Logout</a>
                </li>
            </template>
            <template v-else>
                <li>
                    <router-link
                        :to="{
                        name: 'login'
                    }"
                    >Login</router-link>
                </li>
            </template>
        </ul>
    </nav>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
        })
    },

    methods: {
        // logout action under auth/logout
        ...mapActions({
            logoutAction: "auth/logout"
        }),

        // once the logout action has taken placeredirect to the homepage
        logout() {
            this.logoutAction().then(() => {
                this.$router.replace({
                    name: "home"
                });
            });
        }
    }
};
</script>