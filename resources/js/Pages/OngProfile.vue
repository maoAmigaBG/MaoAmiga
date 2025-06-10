<template>
    <ParallaxBanner :bg="bg" class="pt-0!">
        <h1 v-if="props.ong" class="capitalize">{{ props.ong.nome }}</h1>
    </ParallaxBanner>
</template>

<script setup>
import bg from '@/assets/puppy.jpg';
import ParallaxBanner from '../components/ParallaxBanner.vue';

const props = defineProps({ ong: Object });
</script>