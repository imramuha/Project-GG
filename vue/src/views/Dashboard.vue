 <template>
    <div>
        <h1>Dashboard</h1>
        <template v-if="!isLoading">
            <PostCard v-for="post in posts" :key="post.id" :event="post" />
        </template>
        <p v-else>Loading posts</p>
    </div>
</template>
    
    <script>
import axios from "axios";
import PostCard from "../components/PostCard";
export default {
    components: { PostCard },
    data() {
        return {
            isLoading: true,
            posts: []
        };
    },
    created() {
        axios.get("http://127.0.0.1:8000/api/frontend/posts").then(({ data }) => {
            this.posts = data.posts;
            this.isLoading = false;
        });
    }
};
</script>