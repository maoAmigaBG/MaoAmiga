<template>
    <ParallaxBanner :bg="bgImage">
        <div class="vignette h-full">
            <div class="h-full max-w-1/2 mx-auto flex items-center justify-center">
                <h1 class="font-bold font-poppins text-slate-50 text-5xl text-center text-pretty">{{ props.campaign.nome }}</h1>
            </div>
        </div>
    </ParallaxBanner>

    <div class="main-content py-4 px-10">
        <h1 class="font-bold font-poppins text-purple-800 text-3xl py-2">Sobre a Iniciativa</h1>
        <p class="text-lg indent-8 py-4">{{ props.campaign.descricao }}</p>
        
        <div v-if="props.campaign.materiais.length !== 0" class="needed w-[95%] min-h-40 bg-slate-200 rounded-lg px-4 py-2">
            <h3 class="font-bold font-poppins text-purple-800 text-xl py-2">Materiais Necessários</h3>

            <div class="list w-full flex flex-col gap-2 my-4">
                <div v-for="material in props.campaign.materiais" class="w-full px-4 py-2 bg-slate-50 rounded-lg">
                    <p class="font-poppins text-lg">{{ material }}</p>
                </div>
            </div>

        </div>
    </div>
</template>

<style>
    .vignette {
        box-shadow: inset 0 0 150px 75px rgba(0,0,0,0.7) ;
    }
</style>

<script setup>
import { defineProps, onMounted } from 'vue';
import ParallaxBanner from '../../components/ParallaxBanner.vue';

const props = defineProps({
    'campaign': Object
});

const bgImage = '../storage/' + props.campaign.foto;
</script>