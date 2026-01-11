import { reactive } from 'vue';

// Estado global compartido para los toasts
const toastState = reactive({
  toasts: [],
  toastId: 0,
});

export function useToast() {
  const showToast = (message, type = 'info', duration = 5000) => {
    const id = toastState.toastId++;
    const toast = {
      id,
      message,
      type,
      duration,
    };

    toastState.toasts.push(toast);

    if (duration > 0) {
      setTimeout(() => {
        removeToast(id);
      }, duration);
    }

    return id;
  };

  const removeToast = (id) => {
    const index = toastState.toasts.findIndex((t) => t.id === id);
    if (index > -1) {
      toastState.toasts.splice(index, 1);
    }
  };

  return {
    toasts: toastState.toasts,
    success: (message, duration) => showToast(message, 'success', duration),
    error: (message, duration) => showToast(message, 'error', duration),
    warning: (message, duration) => showToast(message, 'warning', duration),
    info: (message, duration) => showToast(message, 'info', duration),
    remove: removeToast,
  };
}
