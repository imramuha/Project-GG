<template>
    <div>
        <p>Feed component {{ data }}</p>
    </div>
</template>

<script>
export default {
    name: "Feed",
    props: {
        data: {
            type: Object,
            default: () => {
                return {};
            }
        }
    }
};
   
</script>

<style></style>
