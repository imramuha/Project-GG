<template>
    <div>
        <form @submit.prevent="search">
            <input type="text" placeholder="Search a player.." v-model="searchTerm" />
            <button type="submit">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>
</template>
<script>
export default {    
    data() {
        return {
            searchTerm: null,
        };
    },
    methods: {
        search() {
            let value = {
              component: "UserSearch",
              searchTerm: this.searchTerm,
        
            }
            this.emitToPosts(value);
        },
        emitToPosts(value) {
            this.$emit("emitToOverscreen", value);
        }
    }
};
</script>
<style scoped></style>
