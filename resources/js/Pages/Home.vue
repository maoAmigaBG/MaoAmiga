<template>
  <Feeds :posts="posts.data" :nextPageUrl="posts.next_page_url" v-slot="{post}">
    <Feed :post="post" :login_checked="login_checked" :auth="auth"/>
  </Feeds>
</template>

<script setup>
import Feeds from '../components/Feeds.vue'
import Feed from '../components/Feed.vue'

const props = defineProps({
  auth: Object,
  posts: Object,
  login_checked: Boolean
})
</script>