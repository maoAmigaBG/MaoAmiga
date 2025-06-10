<template>
  <div class="scroller-spacer self-start pt-4 px-4">
    <h1 class="section-title font-poppins font-semibold text-2xl text-gray-600 pb-2">ONGs Disponíveis</h1>
  </div>
  <div class="ong-grid grid grid-cols-1 gap-4 p-4">
    <OngCard v-for="(n, i) in 10" :key="i" />
  </div>
</template>

<script setup>
import OngCard from '../Components/OngCard.vue'
</script>