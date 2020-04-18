<template>
    <div>
        <p>This is user X's profile {{ id }}</p>
        <ul>
            <li>User X </li>
            <li>User X facepic :)</li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ['id']
}
</script>

<style>

</style>