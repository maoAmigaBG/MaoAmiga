<template>
    <DefaultHeader/>

    <div class="container">
        <router-view/>
    </div>
</template>

<script setup>
    import DefaultHeader from './components/DefaultHeader.vue';
</script>