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
            <RankCard v-for="(membro, i) in ranking" :key="membro.user_id || i" :index="i" :membro="membro" />
          </div>
        </Scroller>
      </div>
    </div>

    <div class="flex-1 flex flex-col self-center min-h-screen w-1/2 pt-[91px] pb-2">
      <slot></slot>
    </div>

    <div class="w-[25%] border-l-2 border-[#E5E4E2]">
      <div class="sticky top-[91px]">
        <Scroller class="h-[calc(100vh-91px)]">
          <h2 class="section-title font-poppins font-semibold text-2xl text-gray-600 pb-5 self-start">Campanhas</h2>
          <div class="flex flex-col gap-y-4">
            <CampaignCard v-for="(campanha, i) in campaigns" :key="campanha.id || i" :index="i" :campanha="campanha" />
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

const { ranking, campaigns } = defineProps({
  posts: Array,
  ranking: Array,
  campaigns: Array
})
</script>