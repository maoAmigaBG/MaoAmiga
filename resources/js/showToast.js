import { createVNode, render } from "vue";
import Toast from "./Components/ToastModal.vue";

export default function showToast({ title = "Modal Title", message = "This is the modal message", type = "info", duration = 3000 }) {
    const container = document.createElement("div");
    document.body.appendChild(container);

    const toastVNode = createVNode(Toast, {
        title,
        message,
        type,
        duration,
        onVnodeUnmounted() {
            document.body.removeChild(container);
        },
    });

    render(toastVNode, container);
}