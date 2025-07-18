<template>
    <ParallaxBanner :bg="'/storage/' + props.ong.banner" class="pt-0!">
        <div class="h-full w-full flex gap-4 items-end p-4 shadow-[inset_0_-35px_16px_-25px_rgba(0,0,0,0.8)]">
            <div class="ong-image-wrapper max-w-1/3 aspect-square">
                <img class="h-full border-4 border-purple-800 rounded-md object-cover"
                    :src="'/storage/' + props.ong.foto" alt="">
            </div>
            <div class="ong-info text-shadow-lg h-full flex flex-1 flex-col justify-center relative">
                <h1 class="text-4xl text-white font-bold font-poppins">{{ props.ong.nome }}</h1>
                <small class="text-xl text-white font-poppins">{{ props.ong.subtitulo }}</small>
                <div class="info-footer absolute bottom-0 left-0 right-0 flex items-center justify-between gap-8 pb-5 px-4">
                    <div class="flex gap-8">
                        <span class="type flex gap-2 items-center text-white text-2xl">
                            <i class="fas fa-hands-helping"></i> {{ props.ong_type.nome }}
                        </span>
                        <span class="members flex gap-2 items-center text-white text-2xl">
                            <i class="fa-solid fa-users"></i> {{ props.members_amount }}
                        </span>
                    </div>
                    
                    <Link v-if="props.is_adm"
                        :href="`/ong/edit/${props.ong.id}`"
                        class="flex items-center justify-center gap-2 text-white text-2xl hover:text-purple-600"
                    >
                        <i class="fas fa-edit"></i>
                        Editar
                    </Link>
                </div>
            </div>
        </div>
    </ParallaxBanner>
    <div class="ong-nav w-full h-15 p-2">
        <ul
            class="nav-links h-full flex justify-between items-center px-25 border-2 border-purple-800 rounded-md text-xl text-gray-600 font-bold">
            <li :class="currentTab === 'sobre' ? 'bg-purple-800 text-white' : 'text-gray-600'">
                <button @click="currentTab = 'sobre'" class="px-4 py-2 rounded-md transition">Sobre</button>
            </li>
            <li :class="currentTab === 'campanhas' ? 'bg-purple-800 text-white' : 'text-gray-600'">
                <button @click="currentTab = 'campanhas'" class="px-4 py-2 rounded-md transition">Campanhas</button>
            </li>
            <li :class="currentTab === 'posts' ? 'bg-purple-800 text-white' : 'text-gray-600'">
                <button @click="currentTab = 'posts'" class="px-4 py-2 rounded-md transition">Post</button>
            </li>
            <li :class="currentTab === 'contatos' ? 'bg-purple-800 text-white' : 'text-gray-600'">
                <button @click="currentTab = 'contatos'" class="px-4 py-2 rounded-md transition">Contatos</button>
            </li>
        </ul>
    </div>
    <div class="main-ong-content py-4 px-10">
        <template v-if="currentTab === 'sobre'">
            <h1 class="text-2xl text-gray-600 font-bold py-2">Sobre Nós</h1>
            <p class="text-lg indent-8">{{ props.ong.descricao }}</p>
        </template>

        <template v-else-if="currentTab === 'campanhas'">
            <h1 class="text-2xl text-gray-600 font-bold py-2">Campanhas</h1>
            <template v-for="(campaign, index) in props.campaigns">
                <CampaignCard :campanha="campaign" />
            </template>
        </template>

        <template v-else-if="currentTab === 'posts'">
            <h1 class="text-2xl text-gray-600 font-bold py-2">Posts</h1>
            <ul class="list-disc pl-6">
                <li v-for="post in props.reports" :key="post.id">
                    {{ post.titulo }} - {{ post.conteudo }}
                </li>
            </ul>
        </template>

        <template v-else-if="currentTab === 'contatos'">
            <h1 class="text-2xl text-gray-600 font-bold py-2">Contatos</h1>
            <ul class="list-disc pl-6">
                <li v-for="contato in props.contacts" :key="contato.id">
                    {{ contato.nome }} - {{ contato.email }}
                </li>
            </ul>
        </template>
    </div>

</template>

<script setup>
import { ref } from 'vue';
import ParallaxBanner from '../../../components/ParallaxBanner.vue';
import CampaignCard from '../../../components/CampaignCard.vue';

const props = defineProps({
    ong: Object,
    ong_type: Object,
    contacts: Array,
    reports: Array,
    campaigns: Array,
    is_adm: Object,
    members_amount: Number,
    is_adm: Boolean
});

const currentTab = ref('sobre');
</script>
