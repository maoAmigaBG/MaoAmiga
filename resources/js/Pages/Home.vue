<template>
  <Feeds :posts="posts" :nextPageUrl="nextPageUrl" v-slot="{post}">
    <Feed :post="post" />
  </Feeds>
</template>


<script setup>
import Feeds from '../components/Feeds.vue'
import Feed  from '../components/Feed.vue'

const props = defineProps({ 
  posts: Array,
  nextPageUrl: String
 })
</script>
