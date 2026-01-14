<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 px-4 py-12">
    <Transition name="fade" appear>
      <div class="w-full max-w-md">
        <!-- Card principal con efecto glassmorphism -->
        <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-2xl p-8 md:p-10 border border-white/20">
          <!-- Logo/Header -->
          <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl shadow-lg mb-4 transform transition-transform hover:scale-105">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Bienvenido</h2>
            <p class="text-gray-600 text-sm">Inicia sesión para continuar</p>
        </div>

          <form @submit.prevent="handleLogin" class="space-y-5">
            <!-- Error message -->
            <Transition name="slide-down">
              <div v-if="error" class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-r-lg flex items-start gap-3">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span class="text-sm font-medium">{{ error }}</span>
              </div>
            </Transition>

            <!-- Email field -->
            <div class="space-y-2">
              <label for="email" class="block text-sm font-semibold text-gray-700">
                Correo electrónico
                <span class="text-red-500 ml-1">*</span>
          </label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                  </svg>
                </div>
          <input
            id="email"
            v-model="form.email"
            type="email"
            required
                  autocomplete="email"
                  class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/50 hover:bg-white"
            placeholder="tu@email.com"
          />
              </div>
        </div>

            <!-- Password field -->
            <div class="space-y-2">
              <label for="password" class="block text-sm font-semibold text-gray-700">
                Contraseña
                <span class="text-red-500 ml-1">*</span>
          </label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                  </svg>
                </div>
          <input
            id="password"
            v-model="form.password"
            type="password"
            required
                  autocomplete="current-password"
                  class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white/50 hover:bg-white"
            placeholder="••••••••"
          />
              </div>
        </div>

            <!-- Remember me -->
            <div class="flex items-center justify-between">
              <label class="flex items-center cursor-pointer group">
          <input
            id="remember"
            v-model="form.remember"
            type="checkbox"
                  class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition-colors cursor-pointer"
          />
                <span class="ml-2 text-sm text-gray-700 group-hover:text-gray-900 transition-colors">
            Recordarme
                </span>
          </label>
        </div>

            <!-- Submit button -->
        <button
          type="submit"
          :disabled="loading"
              class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 px-4 rounded-lg font-semibold shadow-lg hover:shadow-xl transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none flex items-center justify-center gap-2"
        >
              <svg v-if="loading" class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
          <span v-if="loading">Iniciando sesión...</span>
          <span v-else>Iniciar Sesión</span>
        </button>
      </form>
    </div>
      </div>
    </Transition>
  </div>
</template>

<script>
import { ref, reactive } from 'vue';
import axios from 'axios';
import { useToast } from '../composables/useToast';

export default {
  name: 'Login',
  emits: ['login-success'],
  setup(props, { emit }) {
    const toast = useToast();
    const loading = ref(false);
    const error = ref('');

    const form = reactive({
      email: '',
      password: '',
      remember: false,
    });

    const handleLogin = async () => {
      // Validación básica
      if (!form.email || !form.email.trim()) {
        toast.warning('El email es obligatorio.');
        return;
      }
      if (!form.password || !form.password.trim()) {
        toast.warning('La contraseña es obligatoria.');
        return;
      }

      loading.value = true;
      error.value = '';

      try {
        const response = await axios.post('/api/login', form, {
          withCredentials: true,
        });
        if (response.data) {
          toast.success('Inicio de sesión exitoso.');
          emit('login-success');
        }
      } catch (err) {
        console.error('Error de login:', err);
        if (err.response && err.response.data) {
          if (err.response.data.errors) {
            const errors = err.response.data.errors;
            Object.keys(errors).forEach((field) => {
              errors[field].forEach((message) => {
                toast.error(message);
              });
            });
            error.value = errors.email ? errors.email[0] : 'Error al iniciar sesión';
          } else if (err.response.data.message) {
            toast.error(err.response.data.message);
            error.value = err.response.data.message;
          } else {
            toast.error('Error al iniciar sesión. Verifica tus credenciales.');
            error.value = 'Error al iniciar sesión. Verifica tus credenciales.';
          }
        } else {
          toast.error('Error de conexión. Por favor, verifica tu conexión a internet.');
          error.value = 'Error de conexión. Por favor, verifica tu conexión a internet.';
        }
      } finally {
        loading.value = false;
      }
    };

    return {
      form,
      loading,
      error,
      handleLogin,
    };
  },
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
}

.fade-enter-from {
  opacity: 0;
  transform: translateY(-20px);
}

.fade-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}

.slide-down-enter-active,
.slide-down-leave-active {
  transition: all 0.3s ease;
}

.slide-down-enter-from {
  opacity: 0;
  transform: translateY(-10px);
  max-height: 0;
}

.slide-down-leave-to {
  opacity: 0;
  transform: translateY(-10px);
  max-height: 0;
}
</style>
