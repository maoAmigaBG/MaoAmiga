<template>
  <Feeds :posts="posts" :nextPageUrl="nextPageUrl" v-slot="{post}">
    <Feed
      :key="post.id"
      :ongId="post.ong.id"
      :postId="post.id"
      :ongName="post.ong.nome"
      :ongImage="post.ong.foto"
      :addr="post.ong.endereco"
      :time="post.created_at"
      :foto="post.foto"
      :description="post.descricao"
      :liked="post.liked"
      :likeId="post.likes?.[0]?.id"
    />
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
