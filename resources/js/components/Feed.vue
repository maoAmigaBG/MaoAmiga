<template>
  <div class="feed relative w-full p-5 font-poppins bg-slate-50 border-b-2 border-[#E5E4E2]">

    <div class="head flex justify-between p-2.5">

      <Link :href="`/ong/profile/${ongId}`" class="user flex items-center gap-2.5 no-underline">
        <div class="profile-img">
          <img :src="'/storage/' + ongImage"
               alt=""
               class="h-[70px] w-[70px] object-cover object-center rounded-full" />
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
        <img :src="'/storage/' + foto" alt="" class="w-full h-[400px] object-cover object-center"/>
      </div>

      <div class="action-buttons w-1/3 flex justify-between items-center text-[28px] my-2 mb-4">
        <Link :href="`/post/like/${postId}`"><i class="fa-regular fa-heart"></i></Link>
        <i class="fa-regular fa-comments"></i>
        <i class="fa-regular fa-share-from-square"></i>
      </div>
    </template>

    <div class="caption mb-2">
      <b>{{ ongName }}</b> {{ description }}
    </div>

    <div v-if="!foto"
         class="action-buttons w-1/3 flex justify-between items-center text-[28px] my-4">
      <Link :href="`/post/like/${postId}`"><i class="fa-regular fa-heart"></i></Link>
      <i class="fa-regular fa-comments"></i>
      <i class="fa-regular fa-share-from-square"></i>
    </div>

  </div>
</template>

<script setup>
import { computed } from 'vue'
import { Link }     from '@inertiajs/vue3'

const props = defineProps({
  ongId: Number,
  postId: Number,
  ongName: String,
  ongImage: String,
  addr: String,
  time: String,
  foto: String,
  description: String,
})

const formattedTime = computed(() => {
  if (!props.time) return ''
  return new Date(props.time)
    .toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
})
</script>
