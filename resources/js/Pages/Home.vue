<template>
  <Feeds>
    <Feed
      v-for="post in posts"
      :key="post.id"
      :ongId="post.ong.id"
      :postId="post.id"   
      :ongName="post.ong.nome"
      :ongImage="post.ong.foto"
      :addr="post.ong.endereco"
      :time="post.created_at"
      :foto="post.foto"
      :description="post.descricao"
    />
  </Feeds>
</template>

<script setup>
import Feeds from '../components/Feeds.vue'
import Feed  from '../components/Feed.vue'

const props = defineProps({ posts: Array })
</script>
