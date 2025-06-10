<template>
  <div class="map-wrapper flex justify-center items-center w-full h-full p-2">
    <Mapa :height="'80vh'" :width="'50vw'" />
  </div>
</template>

<script setup>
import Mapa from '../components/Map.vue';
</script>