<template>
    <div class="parallax-banner w-full h-[40vh] relative overflow-hidden flex" :style="{
         backgroundImage: `url('${bg}')`}"
        >
        <div class="z-10 flex-1">
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