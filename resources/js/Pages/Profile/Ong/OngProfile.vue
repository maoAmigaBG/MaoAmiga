<template>
    <ParallaxBanner :bg="'/storage/' + props.ong.banner" class="pt-0!">
        <div class="h-full w-full flex gap-4 items-end p-4 shadow-[inset_0_-35px_16px_-25px_rgba(0,0,0,0.8)]">
            <div class="ong-image-wrapper max-w-1/3 aspect-square">
                <img class="h-full border-4 border-purple-800 rounded-md object-cover" :src="'/storage/' + props.ong.foto" alt="">
            </div>
            <div class="ong-info text-shadow-lg h-full flex flex-1 flex-col justify-center">
                <h1 class="text-4xl text-white font-bold font-poppins">{{ props.ong.nome }}</h1>
                <small class="text-xl text-white font-poppins">{{ props.ong.subtitulo }}</small>
                <div class="info-footer absolute bottom-0 flex gap-8 pb-5">
                    <span class="type flex gap-2 items-center text-white text-2xl">
                        <i class="fas fa-hands-helping"></i> {{ props.ong_type.nome }}
                    </span>
                    <span class="members flex gap-2 items-center text-white text-2xl">
                        <i class="fa-solid fa-users"></i> {{ props.members_amount }}
                    </span>
                </div>
            </div>
        </div>
    </ParallaxBanner>
    <div class="ong-nav w-full h-15 p-2">
        <ul class="nav-links h-full flex justify-between items-center px-25 border-2 border-purple-800 rounded-md text-xl text-gray-600 font-bold">
            <li><a href="">Sobre</a></li>
            <li><a href="">Campanhas</a></li>
            <li><a href="">Post</a></li>
            <li><a href="">Contatos</a></li>
        </ul>
    </div>
    <div class="main-ong-content py-4 px-10">
        <h1 class="text-2xl text-gray-600 font-bold py-2">Sobre Nós</h1>
        <p class="text-lg indent-8">{{ props.ong.descricao }}</p>
    </div>
</template>

<script setup>
import bg from '@/assets/puppy.jpg';
import ParallaxBanner from '../../../components/ParallaxBanner.vue';

const props = defineProps({ 
    ong: Object,
    ong_type: Object,
    members_amount: Number,
});
</script>