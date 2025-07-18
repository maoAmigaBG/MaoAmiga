<template>
  <div class="feed relative w-full p-5 font-poppins bg-slate-50 border-b-2 border-[#E5E4E2]">
    <div v-if="isModalOpen" class="fixed inset-0 backdrop-blur-md flex justify-center items-center z-50 p-6"
      @click="fecharModal">
      <img :src="modalImageUrl" alt="Imagem ampliada" class="w-5/12 object-contain rounded-lg shadow-lg"
        @click.stop />
    </div>

    <div class="head flex justify-between p-2.5">
      <Link :href="`/ong/profile/${post.ong.id}`" class="user flex items-center gap-2.5 no-underline">
      <div class="profile-img">
        <img :src="'/storage/' + post.ong.foto" alt=""
          class="h-[70px] w-[70px] object-cover object-center rounded-full" />
      </div>
      <div class="info w-3/4">
        <h3 class="font-semibold">{{ post.ong.nome }}</h3>
        <small class="truncate w-full block">{{ post.ong.endereco }}</small>
        <small v-if="post.created_at">{{ formattedTime }}</small>
      </div>
      </Link>
      <span class="edit flex items-center text-[28px]">
        <i class="fa-solid fa-ellipsis"></i>
      </span>
    </div>

    <template v-if="post.foto">
      <div class="photo my-4 rounded-[7px_40px_7px_92px] overflow-hidden cursor-pointer"
        @click="abrirModalComImagem('/storage/' + post.foto)">
        <img :src="'/storage/' + post.foto" alt="" class="w-full h-[400px] object-cover object-center" />
      </div>

      <div class="action-buttons w-1/3 flex justify-between items-center text-[28px] my-2 mb-4">
        <i @click="toggleLike" :class="[
          'cursor-pointer',
          animating ? 'pop-animation' : '',
          isLiked ? 'fa-solid fa-heart text-red-800' : 'fa-regular fa-heart'
        ]"></i>
        <i class="fa-regular fa-comments"></i>
        <i class="fa-regular fa-share-from-square"></i>
      </div>
    </template>

    <div class="caption mb-2">
      <b>{{ post.ong.nome }}</b> {{ post.descricao }}
    </div>

    <div v-if="!post.foto" class="action-buttons w-1/3 flex justify-between items-center text-[28px] my-4">
      <i @click="toggleLike" :class="[
        'cursor-pointer',
        animating ? 'text-red-800 animate-pop' : '',
        isLiked ? 'fa-solid fa-heart text-red-800' : 'fa-regular fa-heart'
      ]"></i>
      <i class="fa-regular fa-comments"></i>
      <i class="fa-regular fa-share-from-square"></i>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { Link } from '@inertiajs/vue3'
import axios from 'axios'

const emit = defineEmits(['update-likes'])
const props = defineProps({ post: Object })

const isLiked = ref(props.post.liked)
const likeId = ref(props.post.likes?.[0]?.id ?? null)
const animating = ref(false)

watch(() => props.post.liked, (v) => (isLiked.value = v))
watch(() => props.post.likes, (v) => (likeId.value = v?.[0]?.id ?? null))

const formattedTime = computed(() => {
  return props.post.created_at
    ? new Date(props.post.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
    : ''
})

function animateLike() {
  animating.value = true
  setTimeout(() => (animating.value = false), 500)
}

async function toggleLike() {
  const idToRemove = likeId.value || props.post.like_id
  if (isLiked.value) {
    if (!idToRemove) return
    await axios.get(`/post/deslike/${idToRemove}`)

    isLiked.value = false
    likeId.value = null
    props.post.liked = false
    props.post.like_id = null

    emit('update-likes', { action: 'remove', postId: props.post.id })
  } else {
    animateLike()
    const { data } = await axios.get(`/post/like/${props.post.id}`)
    if (data.like_id) {
      isLiked.value = true
      likeId.value = data.like_id
      props.post.like_id = data.like_id
      props.post.liked = true

      emit('update-likes', { action: 'add', post: props.post })
    }
  }
}

const isModalOpen = ref(false)
const modalImageUrl = ref('')

function abrirModalComImagem(url) {
  modalImageUrl.value = url
  isModalOpen.value = true
}

function fecharModal() {
  isModalOpen.value = false
}
</script>

<style scoped>
@keyframes pop {
  0% {
    transform: scale(0) rotate(0deg);
    opacity: 0;
  }

  50% {
    transform: scale(1.4) rotate(180deg);
    opacity: 1;
  }

  100% {
    transform: scale(1) rotate(360deg);
    opacity: 1;
  }
}

.pop-animation {
  animation: pop 0.5s ease-out forwards;
}

.backdrop-blur-sm {
  backdrop-filter: blur(4px);
}
</style>
