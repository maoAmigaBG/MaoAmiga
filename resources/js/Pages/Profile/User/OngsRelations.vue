<template>
  <div class="ong-relations-wrapper min-w-full flex flex-col justify-center">
    <div
      class="profile-box relative w-full h-50 flex flex-col bg-gradient-to-t from-violet-900 to-purple-500 text-center text-white p-10">
      <img class="profile-pic absolute top-[50%] w-48 p-2 bg-purple-50 rounded-full shadow-lg"
        :src="props.user.foto ? '/storage/' + props.user.foto : defaultUserImg" alt="Foto do usuário" />
    </div>
    <div class="relations-info pt-30 pb-3 px-10">
      <div class="ong-relations-header flex items-center justify-between">
        <h3 class="font-poppins font-bold text-2xl text-purple-800 pb-4">ONGs Relacionadas: </h3>
        <button
          class="flex items-center gap-2 bg-purple-800 font-bold text-white px-4 py-3 rounded hover:bg-purple-600">
          <i class="fa-solid fa-pen-to-square"></i>
          Gerenciar ONGs
        </button>
      </div>
    </div>
    <div class="ong-relations flex flex-col gap-4 py-6 px-10">
      <div v-for="(ong, index) in props.ong_relations" :key="ong.id"
        class="bg-white rounded p-4 flex items-center gap-4 shadow-sm border-2 border-purple-800 hover:shadow-md transition">
        <img class="w-20 h-20 object-cover rounded border-2 border-purple-800" :src="`/storage/${ong.foto}`" alt="Imagem da ONG" />
        <div class="flex-1 gap-2">
          <h3 class="font-bold text-lg text-purple-800">{{ ong.nome }}</h3>
          <p class="font-bold text-sm text-gray-600">{{ ong.type }}</p>
          <p v-if="ong.created_at" class="text-gray-500 text-xs">
            Ativo desde: {{ formatarData(ong.created_at) }}
          </p>
          <p v-else class="text-gray-400 text-xs mt-1 italic">
            Data indisponível
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="flex-1 flex flex-col gap-4">

    <div class="flex flex-col gap-3">

    </div>
  </div>
</template>

<script setup>
import defaultUserImg from '@/assets/default_user.jpg';

const props = defineProps({
  ong_relations: Array,
  user: Object,
})

function formatarData(data) {
  const d = new Date(data)
  return d.toLocaleDateString('pt-BR', {
    day: '2-digit',
    month: 'long',
    year: 'numeric'
  })
}
</script>