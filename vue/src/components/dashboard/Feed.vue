<template>
    <div>
        Feed component {{ data }}
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
