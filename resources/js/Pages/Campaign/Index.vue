<template>
    <ParallaxBanner :bg="bgImage"/>
</template>

<script setup>
import { defineProps, onMounted } from 'vue';
import ParallaxBanner from '../../components/ParallaxBanner.vue'; 

const props = defineProps({
    'campaign': Object
});

const bgImage = '../storage/' + props.campaign.foto;
</script>