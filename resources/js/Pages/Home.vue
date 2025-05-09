<template>
    <Feeds>
        <Feed v-for="i in 3" :key="i"/>
    </Feeds>
</template>

<script setup>
    import Feeds from '../Components/Feeds.vue'
    import Feed from '../Components/Feed.vue'
</script>