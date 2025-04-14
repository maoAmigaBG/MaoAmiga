<template>
    <div class="ranking-card">

        <span :class="{
            'rank': true,
            'podium': index < 3,
        }" v-if="index <= 2">
            <img :src="medalImages[index]" :alt="`Medal ${index + 1}`" />
        </span>
        <span class="rank" v-else>{{ index + 1 }}</span>


        <div class="body">
            <div class="profile-image">
                <img src="@/assets/puppy.jpg" alt="Africano Caçando Cachorro">
            </div>
            <div class="points-wrapper">
                <span class="user">@raaaaaaa</span>
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