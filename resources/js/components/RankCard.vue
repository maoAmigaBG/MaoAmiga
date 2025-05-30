<template>
  <div class="ranking-card w-full min-h-[60px] flex items-center justify-between gap-2.5 p-2.5 font-poppins border-b-2 border-[#E4E4F1] overflow-hidden transition-all duration-300 hover:shadow-md hover:scale-105">
    <span v-if="index <= 2" :class="['rank', 'podium', 'h-full', 'flex', 'items-center', 'justify-center', 'px-4', 'text-lg', 'font-semibold', 'text-[#BF3BF7]']">
      <img :src="medalImages[index]" :alt="`Medal ${index + 1}`" class="max-w-[40px]" />
    </span>
    <span v-else class="rank h-full flex items-center justify-center px-4 text-lg font-semibold text-[#BF3BF7]">{{ index + 1 }}</span>
    <div class="body w-full flex items-center gap-2.5">
      <div class="profile-image w-fit h-fit border-[3px] border-[#BF3BF7] rounded-full">
        <img src="@/assets/puppy.jpg" alt="Africano Caçando Cachorro" class="w-[50px] h-[50px] object-cover object-center border border-[#F6F6FA] rounded-full" />
      </div>
      <div class="points-wrapper flex flex-col gap-0.5">
        <span class="user font-semibold text-[#BF3BF7]">@raaaaaaa</span>
        <span class="quantity">R$ 10.000,00</span>
      </div>
    </div>
  </div>
</template>

<script>
import medal1 from '@/assets/medal1.png'
import medal2 from '@/assets/medal2.png'
import medal3 from '@/assets/medal3.png'

export default {
    name: 'RankCard',
    props: {
        index: Number,
    },

    data() {
        return {
            medalImages: [medal1, medal2, medal3]
        }
    }
}
</script>