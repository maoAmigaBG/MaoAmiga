<template>
  <div class="ong-card h-[250px] flex items-center gap-2.5 bg-[#F6F6FA] rounded-[10px] shadow-md overflow-hidden">
    <div class="profile-image min-w-[250px]">
      <img :src="'/storage/' + ongImage" alt="Perfil da ONG" class="h-[250px] w-[250px] object-cover rounded-[0_25px_0_0]" />
    </div>
    <div class="body relative min-h-full w-full flex flex-col">
      <h3 class="ong-title p-2.5 text-2xl font-semibold font-poppins text-purple-800">{{ ongName }}</h3>
      <span class="ong-info p-[5px_10px] font-poppins line-clamp-3">{{ description }}</span>
      <span class="contributions p-[5px_10px] text-sm text-[#696969] font-poppins">Mais de {{ membersAmount }} contribuíntes</span>
      <button @click="ongRedirect" class="donate-now absolute bottom-2 w-[80%] self-center p-2.5 m-2.5 bg-purple-800 text-2xl font-semibold font-poppins text-[#F6F6FA] text-center rounded-[10px] transition-all duration-300 hover:bg-[#620f80] hover:scale-105 cursor-pointer">Doar Agora</button>
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

const props = defineProps({
  ongId: Number,
  ongName: String,
  ongImage: String,
  description: String,
  membersAmount: Number
})

function ongRedirect() {
  router.visit(`/ong/profile/${props.ongId}`)
}
    
</script>