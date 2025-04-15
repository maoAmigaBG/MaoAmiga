<template>
    <DefaultHeader/>

    <Scroller class="left">
        <h2 class="section-title">Maiores Doadores</h2>
        <RankCard v-for="(n, i) in 10" :key="i" :index="i"/>
    </Scroller>

    <Scroller>
        <h2 class="section-title">Campanhas</h2>
        <CampaignCard v-for="i in 5" :index="i"/>
    </Scroller>

    <div class="container">
        <router-view/>
    </div>
</template>

<script setup>
    import DefaultHeader from './components/DefaultHeader.vue';
    import Scroller from './components/Scroller.vue';
    import CampaignCard from './components/CampaignCard.vue';
    import RankCard from './components/RankCard.vue';
</script>