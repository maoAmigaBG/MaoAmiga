<template>
  <div class="p-6 flex flex-col md:flex-row gap-6">

    <div class="flex flex-col items-center gap-4">
      <img class="w-60 h-55 rounded-md object-cover border"
        :src="'/storage/' + props.user.foto" alt="Foto do usuário" />
      <!-- Quando arrumarmos as fts -->
      <!-- :src="props.user.foto ? props.user.foto : 'alguma foto padrao'" alt="Foto do usuário" /> -->
      <MenuUserProfile />
    </div>

    <div class="flex flex-col gap-2 flex-1">
      <h2 class="text-2xl font-semibold">{{ props.user.name }}</h2>
      <p class="text-gray-600">{{ props.user.email }}</p>

      <div class="flex items-center gap-2 text-gray-700 mt-2">
        <span>📅</span>
        <span>Aqui desde: {{ props.user.created_at }}</span>
      </div>
      <div class="flex items-center gap-2 text-gray-700">
        <span>⏳</span>
        <span>Idade: {{ idade }} anos</span>
      </div>

      <div class="mt-4">
        <h3 class="text-lg font-medium flex items-center gap-1">
          🗣 Descrição
        </h3>
        <p class="text-gray-700 mt-2 text-justify">
          {{ props.user.descricao }}
        </p>
      </div>
    </div>

  </div>
</template>

<script setup>
import { computed } from 'vue';
import MenuUserProfile from '../../../components/MenuUserProfile.vue';

const props = defineProps({
  user: Object
});

const idade = computed(() => {
  if (!props.user.data_nasc) return '?'
  const nasc = new Date(props.user.data_nasc)
  const hoje = new Date()
  let idade = hoje.getFullYear() - nasc.getFullYear()
  const m = hoje.getMonth() - nasc.getMonth()
  if (m < 0 || (m === 0 && hoje.getDate() < nasc.getDate())) {
    idade--
  }
  return idade
})
</script>