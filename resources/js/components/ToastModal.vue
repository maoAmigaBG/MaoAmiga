<template>
    <div
        v-if="isVisible"
        class="toast-container"
    >
        <div class="toast-icon">
            <i v-if="type === 'success'" class="fa fa-circle-check toast-icon-success"></i>
            <i v-if="type === 'error'" class="fa fa-circle-exclamation toast-icon-error"></i>
            <i v-if="type === 'info'" class="fa fa-circle-info toast-icon-info"></i>
        </div>
        <div class="toast-content">
            <h3 class="toast-title">{{ title }}</h3>
            <p v-if="message" class="toast-message">{{ message }}</p>
            <p v-else class="toast-message">
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