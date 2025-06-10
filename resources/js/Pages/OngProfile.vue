<template>
    <ParallaxBanner :bg="bg" class="pt-0!">
        <h1 v-if="ong">{{ ong }}</h1>
    </ParallaxBanner>
</template>

<script setup>
import { computed } from 'vue';
import bg from '@/assets/puppy.jpg';
import ParallaxBanner from '../components/ParallaxBanner.vue';

const { ong } = defineProps({ ong: Object });

console.log(ong);
</script>