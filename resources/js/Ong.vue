<template>
    <h1 class="section-title">ONGs Disponíveis</h1>
    <div class="ong-grid">
        <OngCard v-for="(n, i) in 10"/>
    </div>
</template>

<script setup>
    import OngCard from './components/OngCard.vue'
</script>