<template>
  <div id="app">
    <!-- Home Page -->
    <Home
      v-if="currentView === 'home'"
      @show-products="showProducts"
    />

    <!-- Product List -->
    <ProductList
      v-else-if="currentView === 'products'"
      @back="goHome"
      @select-product="showProductDetail"
    />

    <!-- Product Detail -->
    <ProductDetail
      v-else-if="currentView === 'product-detail'"
      :product-id="selectedProductId"
      @back="showProducts"
      @go-home="goHome"
    />
  </div>
</template>

<script>
import Home from './Home.vue';
import ProductList from './ProductList.vue';
import ProductDetail from './ProductDetail.vue';

export default {
  name: 'App',
  components: {
    Home,
    ProductList,
    ProductDetail
  },
  data() {
    return {
      currentView: 'home', // 'home', 'products', 'product-detail'
      selectedProductId: null
    }
  },
  mounted() {
    // Leer la URL al montar el componente para restaurar la vista
    this.parseUrl();
    
    // Escuchar cambios en la URL (navegación del navegador)
    window.addEventListener('popstate', this.parseUrl);
  },
  beforeUnmount() {
    // Limpiar el listener
    window.removeEventListener('popstate', this.parseUrl);
  },
  methods: {
    parseUrl() {
      const path = window.location.pathname;
      const pathParts = path.split('/').filter(p => p);
      
      // Si estamos en /productos
      if (pathParts[0] === 'productos') {
        // Si hay un ID, mostrar detalle del producto
        if (pathParts[1]) {
          this.selectedProductId = parseInt(pathParts[1]);
          this.currentView = 'product-detail';
        } else {
          // Si no hay ID, mostrar lista de productos
          this.currentView = 'products';
          this.selectedProductId = null;
        }
      } else {
        // Por defecto, mostrar home
        this.currentView = 'home';
        this.selectedProductId = null;
      }
      
      // Scroll al top
      window.scrollTo({ top: 0, behavior: 'instant' });
    },
    updateUrl(view, productId = null) {
      let url = '/';
      
      if (view === 'products') {
        url = '/productos';
      } else if (view === 'product-detail' && productId) {
        url = `/productos/${productId}`;
      }
      
      // Actualizar la URL sin recargar la página
      window.history.pushState({ view, productId }, '', url);
    },
    goHome() {
      this.currentView = 'home';
      this.selectedProductId = null;
      this.updateUrl('home');
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    showProducts() {
      this.currentView = 'products';
      this.selectedProductId = null;
      this.updateUrl('products');
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    showProductDetail(product) {
      this.selectedProductId = product.id;
      this.currentView = 'product-detail';
      this.updateUrl('product-detail', product.id);
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  }
};
</script>

<style>
#app {
  min-height: 100vh;
}

/* Transiciones suaves entre vistas */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.4s ease, transform 0.4s ease;
}

.fade-enter-from {
  opacity: 0;
  transform: translateY(10px);
}

.fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

/* Scrollbar personalizado */
::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>
