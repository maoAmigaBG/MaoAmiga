<template>
    <Feeds>
        <Feed v-for="i in 3" :key="i"/>
    </Feeds>
</template>

<script setup>
    import Feeds from './components/Feeds.vue'
    import Feed from './components/Feed.vue'
</script>