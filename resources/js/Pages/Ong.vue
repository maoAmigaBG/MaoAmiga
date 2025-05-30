<template>
  <div class="scroller-spacer self-start ml-[25%] pt-4 pb-2 pl-2">
    <h1 class="section-title font-poppins font-semibold text-2xl text-gray-600 pb-2">ONGs Disponíveis</h1>
  </div>
  <div class="ong-grid w-1/2 grid grid-cols-1 gap-4">
    <OngCard v-for="(n, i) in 10" :key="i" />
  </div>
</template>

<script setup>
import OngCard from '../Components/OngCard.vue'
</script>