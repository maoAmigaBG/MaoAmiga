<template>

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

      <SubNav class="-mx-10" :items="items" :active="activeKey"/>

      <main class="p-6">
        <slot></slot>
      </main>

      <h3 class="font-poppins font-bold text-2xl text-purple-800 pb-4">Descrição: </h3>
      <p class="font-poppins text-gray-600 text-xl indent-15 pb-6">{{ props.user.descricao }}</p>
    </div>
  </div>

  
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import SubNav from '../../../components/SubNav.vue';
import defaultUserImg from '@/assets/default_user.jpg';

const { props } = usePage()
const user = props.user

const items = [
  { key: 'profile', label: 'Detalhes da Conta', to: `/user/profile/${user.id}` },
  { key: 'manage', label: 'Gerenciar Conta', to: `/user/profile/${user.id}/edit`},
  { key: 'relations', label: 'ONGs Relacionadas', to: `/user/relations/${user.id}`},
  { key: 'exit', label: 'Sair da Conta', to: '/user/logout'}
]

const activeKey = 'profile'
</script>