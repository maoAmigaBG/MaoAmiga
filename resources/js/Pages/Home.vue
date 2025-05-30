<template>
  <div class="feeds flex flex-col items-center gap-2 min-h-screen w-full">
    <Feed v-for="i in 3" :key="i" />
  </div>
</template>

<script setup>
import Feeds from '../Components/Feeds.vue'
import Feed from '../Components/Feed.vue'
</script>