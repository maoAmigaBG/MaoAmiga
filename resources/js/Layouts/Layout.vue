<template>
  <DefaultHeader />

  <div class="flex flex-row min-h-screen bg-slate-50">
    <div class="w-[25%] border-r-2 border-[#E5E4E2]">
      <div class="sticky top-[91px]">
        <Scroller class="left h-[calc(100vh-91px)]">
          <h2 class="section-title font-poppins font-semibold text-2xl text-gray-600 pb-5 self-start">
            Maiores Doadores
          </h2>
          <div class="flex flex-col h-full justify-between gap-4 py-2">
            <RankCard v-for="(n, i) in 10" :key="i" :index="i" />
          </div>
        </Scroller>
      </div>
    </div>

    <div class="flex-1 flex flex-col self-center min-h-screen w-1/2 pt-[91px] pb-2">
      <router-view />
    </div>

    <div class="w-[25%] border-l-2 border-[#E5E4E2]">
      <div class="sticky top-[91px]">
        <Scroller class="h-[calc(100vh-91px)]">
          <h2 class="section-title font-poppins font-semibold text-2xl text-gray-600 pb-5 self-start">Campanhas</h2>
          <div class="flex flex-col gap-y-4">
            <CampaignCard v-for="i in 5" :key="i" :index="i" />
          </div>
        </Scroller>
      </div>
    </div>
  </div>
</template>

<script setup>
import DefaultHeader from '../components/DefaultHeader.vue';
import Scroller from '../components/Scroller.vue';
import CampaignCard from '../components/CampaignCard.vue';
import RankCard from '../components/RankCard.vue';
import Toast from '../components/ToastModal.vue';
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