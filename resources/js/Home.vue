<template>
    <Scroller class="left">
        <h2 class="section-title">Maiores Doadores</h2>
        <RankCard v-for="(n, i) in 10" :key="i" :index="i"/>
    </Scroller>

    <Scroller>
        <h2 class="section-title">Campanhas</h2>
        <CampaignCard v-for="i in 5" :index="i"/>
    </Scroller>

    <Feeds>
        <Feed v-for="i in 3" :key="i"/>
    </Feeds>
</template>

<script setup>
    import Scroller from './components/Scroller.vue'
    import RankCard from './components/RankCard.vue'
    import CampaignCard from './components/CampaignCard.vue'
    import Feeds from './components/Feeds.vue'
    import Feed from './components/Feed.vue'
</script>