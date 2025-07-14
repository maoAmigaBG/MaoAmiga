<template>
  <Link
    :href="`/user/profile/${membro.user_id ?? membro.id}`"
    class="ranking-card w-full min-h-[70px] flex flex-1 items-center justify-between gap-2 p-4
           font-poppins border-b-2 border-[#E4E4F1] overflow-hidden transition-all duration-300
           hover:shadow-md hover:scale-105 no-underline"
  >
    <span v-if="index <= 2"
          class="rank podium h-full flex items-center justify-center w-[56px] text-lg font-semibold text-purple-800">
      <img :src="medalImages[index]" :alt="`Medal ${index + 1}`" class="max-w-[40px]" />
    </span>
    <span v-else class="rank h-full flex items-center justify-center w-[56px] text-lg font-semibold text-purple-800">
      {{ index + 1 }}
    </span>

    <div class="body w-full flex items-center gap-2.5">
      <div class="profile-image w-fit h-fit border-[3px] border-purple-800 rounded-full">
        <img :src="membro.foto ? '/storage/' + membro.foto : defaultUserImg"
             class="w-[50px] h-[50px] object-cover object-center border border-[#F6F6FA] rounded-full" />
      </div>
      <div class="points-wrapper flex flex-col gap-0.5">
        <span class="user font-semibold text-purple-800">{{ membro.name }}</span>
        <span class="quantity">R$ {{ membro.donate_amount }}</span>
      </div>
    </div>
  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import medal1 from '@/assets/medal1.png'
import medal2 from '@/assets/medal2.png'
import medal3 from '@/assets/medal3.png'
import defaultUserImg from '@/assets/default_user.jpg'

const { index, membro } = defineProps({
  index: Number,
  membro: Object
})

const medalImages = [medal1, medal2, medal3]
</script>
