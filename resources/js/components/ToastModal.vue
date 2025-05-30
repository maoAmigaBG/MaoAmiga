<template>
  <div v-if="isVisible" class="toast-container fixed top-8 right-8 z-50 flex items-center p-4 bg-white rounded-lg shadow-lg min-w-[280px]">
    <div class="toast-icon mr-3">
      <i v-if="type === 'success'" class="fa fa-circle-check text-green-500 text-2xl"></i>
      <i v-if="type === 'error'" class="fa fa-circle-exclamation text-red-500 text-2xl"></i>
      <i v-if="type === 'info'" class="fa fa-circle-info text-blue-500 text-2xl"></i>
    </div>
    <div class="toast-content">
      <h3 class="toast-title text-lg font-semibold mb-1">{{ title }}</h3>
      <p v-if="message" class="toast-message text-base">{{ message }}</p>
      <p v-else class="toast-message text-base">
        <slot name="message"></slot>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const props = defineProps({
    title: {
        type: String,
        default: "Notification",
    },
    message: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: "info",
    },
    duration: {
        type: Number,
        default: 3000,
    },
});

const isVisible = ref(true);

onMounted(() => {
    setTimeout(() => {
        isVisible.value = false;
    }, props.duration); 
});
</script>