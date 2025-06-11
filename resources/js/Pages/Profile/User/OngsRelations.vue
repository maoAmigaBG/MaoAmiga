<template>
  <div class="p-6 flex flex-col md:flex-row gap-6">

    <div class="flex flex-col items-center gap-4">
      <img class="w-60 h-55 rounded-md object-cover border"
        :src="'https://i.pinimg.com/736x/b7/a7/7b/b7a77b0fdac3256310750c2217230edc.jpg'" alt="Foto do usuário" />
      <MenuUserProfile />
    </div>

    <div class="flex-1 flex flex-col gap-4">
      <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold">ONGs relacionadas</h2>
        <button class="bg-cyan-900 text-white px-4 py-2 rounded-md flex items-center gap-2 text-sm hover:bg-cyan-800">
          <span>⚙️</span> Gerenciar suas ONGs
        </button>
      </div>

      <div class="flex flex-col gap-3">
        <div v-for="(ong, index) in props.ong_relations" :key="ong.id"
          class="bg-white rounded-md p-4 flex items-center gap-4 shadow-sm border hover:shadow-md transition">
          <img class="w-20 h-20 object-cover rounded-md border" :src="`/storage/${ong.foto}`" alt="Imagem da ONG" />
          <div class="flex-1">
            <h3 class="font-bold text-lg">{{ ong.nome }}</h3>
            <p class="text-gray-600 text-sm">Assunto: {{ ong.type }}</p>
            <p v-if="ong.created_at" class="text-gray-500 text-xs mt-1">
              Ativo desde: {{ formatarData(ong.created_at) }}
            </p>
            <p v-else class="text-gray-400 text-xs mt-1 italic">
              Data não disponível
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import MenuUserProfile from '../../../components/MenuUserProfile.vue'

const props = defineProps({
  ong_relations: Array
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