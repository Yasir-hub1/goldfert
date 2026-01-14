<template>
  <div>
    <!-- Mostrar Login si no está autenticado -->
    <Login v-if="!isAuthenticated" @login-success="handleLoginSuccess" />

    <!-- Mostrar Products CRUD si está autenticado -->
    <Products v-else @logout="handleLogout" />
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Login from './Login.vue';
import Products from './Products.vue';

export default {
  name: 'Admin',
  components: {
    Login,
    Products
  },
  setup() {
    const isAuthenticated = ref(false);

    // Verificar si el usuario ya está autenticado al cargar
    const checkAuth = async () => {
      try {
        await axios.get('/api/user', {
          withCredentials: true,
        });
        isAuthenticated.value = true;
      } catch (error) {
        isAuthenticated.value = false;
      }
    };

    const handleLoginSuccess = () => {
      isAuthenticated.value = true;
    };

    const handleLogout = () => {
      isAuthenticated.value = false;
    };

    onMounted(() => {
      checkAuth();
    });

    return {
      isAuthenticated,
      handleLoginSuccess,
      handleLogout,
    };
  },
};
</script>
