<template>
  <div class="map-wrapper flex justify-center items-center w-full h-full">
    <Mapa :height="'80vh'" :width="'50vw'" />
  </div>
</template>

<script setup>
import Mapa from '../Components/Map.vue';
</script>