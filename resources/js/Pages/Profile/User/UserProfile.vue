<template>

    <!-- <img class="w-60 h-55 rounded-md object-cover border-2 border-purple-800"
          :src="props.user.foto ? '/storage/' + props.user.foto : defaultUserImg" alt="Foto do usuário" /> -->
    <!-- Quando arrumarmos as fts -->
    <!-- :src="props.user.foto ? props.user.foto : 'alguma foto padrao'" alt="Foto do usuário" /> -->
    <!-- <MenuUserProfile :user=props.user /> -->

  <div class="profile-wrapper min-w-full flex flex-col justify-center">
    <div class="profile-box relative w-full h-50 flex flex-col bg-gradient-to-t from-violet-900 to-purple-500 text-center text-white p-10">
      <img 
      class="profile-pic absolute top-[50%] w-48 p-2 bg-purple-50 rounded-full shadow-lg"
      :src="props.user.foto ? '/storage/' + props.user.foto : defaultUserImg" 
      alt="Foto do usuário" />
    </div>
    <div class="profile-info pt-30 px-10">
      <h3 class="font-poppins font-bold text-purple-800 text-4xl pb-2">{{ props.user.name }}</h3>
      <p class="font-poppins text-gray-600 text-xl pb-6">{{ props.user.email }}</p>
      <p class="user-date">
        <span class="inline-flex items-center gap-2 font-bold text-lg text-purple-800 pr-2">
          <i class="fa-solid fa-calendar"></i>
          Ativo desde:
        </span>
        {{ props.user.format_data }}
      </p>
      <p class="user-age">
        <span class="inline-flex items-center gap-2 font-bold text-lg text-purple-800 pr-2 pb-6">
          <i class="fa-solid fa-cake-candles"></i>
          Idade:
        </span>
        {{ props.user.age }} Anos
      </p>

      <h3 class="font-poppins font-bold text-2xl text-purple-800 pb-4">Descrição: </h3>
      <p class="font-poppins text-gray-600 text-xl indent-15 pb-6">{{ props.user.descricao }}</p>
    </div>
  </div>

  
</template>

<script setup>
import { computed } from 'vue';
import MenuUserProfile from '../../../components/MenuUserProfile.vue';
import defaultUserImg from '@/assets/default_user.jpg';

const props = defineProps({
  user: Object
});
</script>