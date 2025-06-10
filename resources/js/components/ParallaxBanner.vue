<template>
    <div class="parallax-banner w-full h-[35vh] relative overflow-hidden flex items-center justify-center" :style="{
         backgroundImage: `url('${bg}')`}"
        >
        <div class="z-10 text-white text-4xl font-bold drop-shadow-lg text-center">
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
defineProps({
    bg: {
        type: String,
        required: true
    }
})
</script>

<style scoped>
.parallax-banner {
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}
</style>