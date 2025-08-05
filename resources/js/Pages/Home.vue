<template>
  <Feeds :posts="posts" :nextPageUrl="nextPageUrl" v-slot="{post}">
    <Feed :post="post" :login_checked="login_checked" />
  </Feeds>
</template>


<script setup>
import Feeds from '../components/Feeds.vue'
import Feed  from '../components/Feed.vue'

const props = defineProps({ 
  posts: Array,
  nextPageUrl: String,
  login_checked: Boolean
 })
</script>
