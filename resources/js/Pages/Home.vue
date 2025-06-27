<template>
  <Feeds>
    <Feed v-for="post in posts" :key="post.id" :ongName="post.nome" :ongImage="post.foto" :addr="post.endereco" :time="post.created_at" :postPhotos="post.photos" :description="post.descricao"/>
  </Feeds>
</template>

<script setup>
import Feeds from '../components/Feeds.vue'
import Feed from '../components/Feed.vue'

const props = defineProps({
  posts: Array,
})

console.log(props.posts)
</script>