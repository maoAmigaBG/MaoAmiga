<template>
  <div class="feed relative w-full p-5 font-poppins bg-slate-50 border-b-2 border-[#E5E4E2]">

    <div class="head flex justify-between p-2.5">

      <Link :href="`/ong/profile/${ongId}`" class="user flex items-center gap-2.5 no-underline">
      <div class="profile-img">
        <img :src="'/storage/' + ongImage" alt="" class="h-[70px] w-[70px] object-cover object-center rounded-full" />
      </div>
      <div class="info w-3/4">
        <h3 class="font-semibold">{{ ongName }}</h3>
        <small class="truncate w-full block">{{ addr }}</small>
        <small v-if="time">{{ formattedTime }}</small>
      </div>
      </Link>

      <span class="edit flex items-center text-[28px]">
        <i class="fa-solid fa-ellipsis"></i>
      </span>
    </div>

    <template v-if="foto">
      <div class="photo my-4 rounded-[7px_40px_7px_92px] overflow-hidden">
        <img :src="'/storage/' + foto" alt="" class="w-full h-[400px] object-cover object-center" />
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
      <b>{{ ongName }}</b> {{ description }}
    </div>

    <div v-if="!foto" class="action-buttons w-1/3 flex justify-between items-center text-[28px] my-4">
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
</style>

<script setup>
import { ref, computed } from 'vue'
import { router, Link } from '@inertiajs/vue3'
import axios from 'axios'

const props = defineProps({
  ongId: Number,
  postId: Number,
  liked: Boolean,
  likeId: Number,
  ongName: String,
  ongImage: String,
  addr: String,
  time: String,
  foto: String,
  description: String,
})

const isLiked = ref(props.liked)
const likeId = ref(props.likeId)
const animating = ref(false)

const formattedTime = computed(() => {
  if (!props.time) return ''
  return new Date(props.time)
    .toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
})

function animateLike() {
  animating.value = true
  setTimeout(() => animating.value = false, 500)
}

async function toggleLike() {
  if (isLiked.value) {
    if (!likeId.value) return

    await axios.get(`/post/deslike/${likeId.value}`)
    isLiked.value = false
    likeId.value = null
  } else {
    animateLike()
    const { data } = await axios.get(`/post/like/${props.postId}`)

    if (data.like_id) {
      isLiked.value = true
      likeId.value = data.like_id
    }
  }
}
</script>
