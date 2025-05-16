<template>
    <div class="scroller-spacer">
        <h1 class="section-title">ONGs Disponíveis</h1>
    </div>
    <div class="ong-grid">
        <OngCard v-for="(n, i) in 10"/>
    </div>
</template>

<script setup>
    import OngCard from '../Components/OngCard.vue'
</script>