<script setup>
const props = defineProps({
  campanha: Object,
  index: Number,
})
</script>

<template>
  <div class="campaign-card p-4 bg-white rounded shadow flex flex-col gap-2">
    <div class="font-bold text-purple-800 text-lg">
      {{ campanha.nome }}
    </div>
    <div v-if="campanha.meta" class="text-gray-500 text-sm">
      Meta: R$ {{ campanha.meta }}
    </div>
    <div v-if="campanha.foto" class="my-2">
      <img :src="'/storage/' + campanha.foto" class="w-full h-32 object-cover rounded" />
    </div>
    <div v-if="campanha.donation_amount" class="text-green-700 text-xs">
      Arrecadado: R$ {{ campanha.donation_amount }}
    </div>
  </div>
</template>