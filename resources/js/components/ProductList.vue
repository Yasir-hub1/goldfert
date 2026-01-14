<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-green-50/30 to-amber-50/20">
        <!-- Header -->
        <div class="bg-white/80 backdrop-blur-lg shadow-sm border-b border-gray-200/50 sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <button
                            @click="$emit('back')"
                            class="flex items-center gap-2 text-green-700 hover:text-green-800 transition-colors p-2 hover:bg-green-50 rounded-lg"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            <span class="font-semibold hidden sm:inline">Volver</span>
                        </button>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 font-display">Catálogo de Productos</h1>
                    </div>
                    <div class="text-sm text-gray-600">
                        <span class="font-semibold text-green-700">{{ filteredProducts.length }}</span> productos disponibles
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
            <!-- Barra de búsqueda y filtros -->
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-lg p-4 sm:p-6 mb-6 border border-white/20" data-aos="fade-down">
                <div class="space-y-4">
                    <!-- Primera fila: Búsqueda y botón limpiar -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input
                                v-model="searchQuery"
                                type="text"
                                placeholder="Buscar productos por nombre o descripción..."
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white/50 hover:bg-white transition-colors"
                            />
                        </div>
                        <button
                            v-if="hasActiveFilters"
                            @click="clearFilters"
                            class="px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors font-medium flex items-center justify-center gap-2 whitespace-nowrap"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Limpiar Filtros
                        </button>
                    </div>

                    <!-- Segunda fila: Filtros -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Cultivo</label>
                            <select
                                v-model="filterCultivo"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white cursor-pointer transition-colors"
                            >
                                <option value="">Todos los cultivos</option>
                                <option v-for="cultivo in uniqueCultivos" :key="cultivo" :value="cultivo">{{ cultivo }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Etapa</label>
                            <select
                                v-model="filterEtapa"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white cursor-pointer transition-colors"
                            >
                                <option value="">Todas las etapas</option>
                                <option v-for="etapa in uniqueEtapas" :key="etapa" :value="etapa">{{ etapa }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading -->
            <div v-if="loading" class="flex justify-center items-center py-20">
                <div class="text-center">
                    <svg class="animate-spin h-12 w-12 text-green-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="text-gray-600 font-medium">Cargando productos...</p>
                </div>
            </div>

            <!-- Sin productos -->
            <div v-else-if="paginatedProducts.length === 0" class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-lg p-12 text-center border border-white/20">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No se encontraron productos</h3>
                <p class="text-gray-600 mb-6">{{ hasActiveFilters ? 'Intenta ajustar los filtros de búsqueda' : 'No hay productos disponibles en este momento' }}</p>
                <button
                    v-if="hasActiveFilters"
                    @click="clearFilters"
                    class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 px-6 rounded-lg transition-colors"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Limpiar Filtros
                </button>
            </div>

            <!-- Grid de productos -->
            <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6">
                <div
                    v-for="(product, index) in paginatedProducts"
                    :key="product.id"
                    :data-aos="'fade-up'"
                    :data-aos-delay="index % 6 * 50"
                    class="bg-white/80 backdrop-blur-lg rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer group border border-white/20"
                    @click="selectProduct(product)"
                >
                    <!-- Imagen del producto -->
                    <div class="relative h-48 sm:h-56 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                        <img
                            v-if="product.foto"
                            :src="product.foto"
                            :alt="product.nombre"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        />
                        <div v-else class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <!-- Badge de precio -->
                        <div class="absolute top-3 right-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white px-3 py-1.5 rounded-lg font-bold text-sm shadow-lg">
                            Bs. {{ formatPrice(product.precio) }}
                        </div>
                    </div>

                    <!-- Información del producto -->
                    <div class="p-4 sm:p-5">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 font-display group-hover:text-green-700 transition-colors line-clamp-2">
                            {{ product.nombre }}
                        </h3>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ product.cultivo }}
                            </span>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ product.etapa }}
                            </span>
                        </div>

                        <!-- Dosis -->
                        <div class="flex items-center gap-2 text-sm text-gray-600 mb-3">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                            <span class="font-medium">{{ product.dosis }}</span>
                        </div>

                        <!-- Descripción corta -->
                        <p class="text-sm text-gray-600 line-clamp-2 mb-4">
                            {{ product.descripcion || 'Sin descripción disponible' }}
                        </p>

                        <!-- Botón ver más -->
                        <button class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-2.5 px-4 rounded-lg transition-all transform group-hover:scale-105 flex items-center justify-center gap-2 shadow-md">
                            <span>Ver Detalles</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Paginación -->
            <div v-if="!loading && filteredProducts.length > 0 && totalPages > 1" class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-lg p-4 sm:p-6 border border-white/20">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-600">
                        Mostrando <span class="font-semibold text-green-700">{{ showingFrom }}</span> -
                        <span class="font-semibold text-green-700">{{ showingTo }}</span> de
                        <span class="font-semibold text-green-700">{{ filteredProducts.length }}</span> productos
                    </div>
                    <div class="flex items-center gap-2">
                        <button
                            @click="goToPage(currentPage - 1)"
                            :disabled="currentPage === 1"
                            class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors flex items-center gap-1"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            <span class="hidden sm:inline">Anterior</span>
                        </button>

                        <div class="flex items-center gap-1">
                            <button
                                v-for="page in visiblePages"
                                :key="page"
                                @click="page !== '...' && goToPage(page)"
                                :class="[
                                    'px-3 py-2 rounded-lg transition-colors min-w-[40px]',
                                    page === currentPage
                                        ? 'bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold shadow-md'
                                        : page === '...'
                                        ? 'text-gray-400 cursor-default'
                                        : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50'
                                ]"
                            >
                                {{ page }}
                            </button>
                        </div>

                        <button
                            @click="goToPage(currentPage + 1)"
                            :disabled="currentPage === totalPages"
                            class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors flex items-center gap-1"
                        >
                            <span class="hidden sm:inline">Siguiente</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ProductList',
    data() {
        return {
            products: [],
            loading: true,
            searchQuery: '',
            filterCultivo: '',
            filterEtapa: '',
            currentPage: 1,
            itemsPerPage: 12
        }
    },
    computed: {
        filteredProducts() {
            let filtered = this.products;

            // Filtrar por búsqueda
            if (this.searchQuery.trim()) {
                const query = this.searchQuery.toLowerCase().trim();
                filtered = filtered.filter(product =>
                    product.nombre?.toLowerCase().includes(query) ||
                    product.descripcion?.toLowerCase().includes(query) ||
                    product.cultivo?.toLowerCase().includes(query) ||
                    product.etapa?.toLowerCase().includes(query)
                );
            }

            // Filtrar por cultivo
            if (this.filterCultivo) {
                filtered = filtered.filter(product => product.cultivo === this.filterCultivo);
            }

            // Filtrar por etapa
            if (this.filterEtapa) {
                filtered = filtered.filter(product => product.etapa === this.filterEtapa);
            }

            return filtered;
        },
        paginatedProducts() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.filteredProducts.slice(start, end);
        },
        totalPages() {
            return Math.ceil(this.filteredProducts.length / this.itemsPerPage);
        },
        showingFrom() {
            if (this.filteredProducts.length === 0) return 0;
            return (this.currentPage - 1) * this.itemsPerPage + 1;
        },
        showingTo() {
            const end = this.currentPage * this.itemsPerPage;
            return Math.min(end, this.filteredProducts.length);
        },
        visiblePages() {
            const pages = [];
            const total = this.totalPages;
            const current = this.currentPage;

            if (total <= 7) {
                for (let i = 1; i <= total; i++) {
                    pages.push(i);
                }
            } else {
                pages.push(1);
                if (current > 3) {
                    pages.push('...');
                }
                const start = Math.max(2, current - 1);
                const end = Math.min(total - 1, current + 1);
                for (let i = start; i <= end; i++) {
                    if (i !== 1 && i !== total) {
                        pages.push(i);
                    }
                }
                if (current < total - 2) {
                    pages.push('...');
                }
                if (total > 1) {
                    pages.push(total);
                }
            }
            return pages;
        },
        hasActiveFilters() {
            return this.searchQuery.trim() !== '' || this.filterCultivo !== '' || this.filterEtapa !== '';
        },
        uniqueCultivos() {
            return [...new Set(this.products.map(p => p.cultivo).filter(Boolean))].sort();
        },
        uniqueEtapas() {
            return [...new Set(this.products.map(p => p.etapa).filter(Boolean))].sort();
        }
    },
    watch: {
        searchQuery() {
            this.currentPage = 1;
        },
        filterCultivo() {
            this.currentPage = 1;
        },
        filterEtapa() {
            this.currentPage = 1;
        }
    },
    mounted() {
        this.fetchProducts();

        // Inicializar AOS si está disponible
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 600,
                once: true
            });
        }
    },
    methods: {
        async fetchProducts() {
            try {
                this.loading = true;
                const response = await axios.get('/api/public/products');
                this.products = response.data;
            } catch (error) {
                console.error('Error al cargar productos:', error);
            } finally {
                this.loading = false;
            }
        },
        selectProduct(product) {
            this.$emit('select-product', product);
        },
        formatPrice(price) {
            return parseFloat(price).toFixed(2);
        },
        clearFilters() {
            this.searchQuery = '';
            this.filterCultivo = '';
            this.filterEtapa = '';
            this.currentPage = 1;
        },
        goToPage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    }
}
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
