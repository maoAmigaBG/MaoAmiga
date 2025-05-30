<template>
  <DefaultHeader />

  <Scroller class="left left-0 right-auto border-l-0 border-r-[3px] border-[#E5E4E2]">
    <h2 class="section-title font-poppins font-semibold text-2xl text-gray-600 pb-5 self-start">Maiores Doadores</h2>
    <RankCard v-for="(n, i) in 10" :key="i" :index="i" />
  </Scroller>

  <Scroller>
    <h2 class="section-title font-poppins font-semibold text-2xl text-gray-600 pb-5 self-start">Campanhas</h2>
    <CampaignCard v-for="i in 5" :key="i" :index="i" />
  </Scroller>

  <div class="container flex flex-col items-center min-h-screen pt-[112px] pb-2 px-5 bg-slate-50">
    <router-view />
  </div>
</template>

<script setup>
import DefaultHeader from '../Components/DefaultHeader.vue';
import Scroller from '../Components/Scroller.vue';
import CampaignCard from '../Components/CampaignCard.vue';
import RankCard from '../Components/RankCard.vue';
import Toast from '../Components/ToastModal.vue';
</script>

<style scoped>
.font-poppins {
  font-family: 'Poppins', Arial, sans-serif;
}

.scroller.left {
  scrollbar-width: none;
}
.scroller.left::-webkit-scrollbar {
  display: none;
}
</style>