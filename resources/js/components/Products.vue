<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/50">
    <!-- Header con navegación -->
    <header class="bg-white/80 backdrop-blur-lg border-b border-gray-200/50 shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 md:h-20">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
              </svg>
            </div>
            <div>
              <h1 class="text-xl md:text-2xl font-bold text-gray-900">Panel de Administración</h1>
              <p class="text-xs md:text-sm text-gray-500 hidden sm:block">Gestión de productos</p>
            </div>
          </div>
          <div class="flex items-center gap-2 md:gap-3">
            <button
              @click="showCreateModal = true"
              class="flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-4 py-2 md:px-5 md:py-2.5 rounded-lg font-semibold shadow-lg hover:shadow-xl transform transition-all duration-200 hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
              <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              <span class="hidden sm:inline">Nuevo Producto</span>
              <span class="sm:hidden">Nuevo</span>
            </button>
            <button
              @click="handleLogout"
              class="flex items-center gap-2 bg-white text-gray-700 border border-gray-300 px-3 py-2 md:px-4 md:py-2.5 rounded-lg font-medium shadow-sm hover:bg-gray-50 hover:shadow-md transform transition-all duration-200 hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
            >
              <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
              <span class="hidden sm:inline">Salir</span>
            </button>
          </div>
        </div>
      </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
      <!-- Estadísticas -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 md:gap-6 mb-6 md:mb-8">
        <div class="bg-white/80 backdrop-blur-lg rounded-xl shadow-lg p-5 border border-white/20 transform transition-all duration-200 hover:scale-105 hover:shadow-xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600 mb-1">Total Productos</p>
              <p class="text-2xl md:text-3xl font-bold text-gray-900">{{ products.length }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
              </svg>
            </div>
          </div>
        </div>
        <div class="bg-white/80 backdrop-blur-lg rounded-xl shadow-lg p-5 border border-white/20 transform transition-all duration-200 hover:scale-105 hover:shadow-xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600 mb-1">Habilitados</p>
              <p class="text-2xl md:text-3xl font-bold text-green-600">{{ enabledCount }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
          </div>
        </div>
        <div class="bg-white/80 backdrop-blur-lg rounded-xl shadow-lg p-5 border border-white/20 transform transition-all duration-200 hover:scale-105 hover:shadow-xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600 mb-1">Deshabilitados</p>
              <p class="text-2xl md:text-3xl font-bold text-red-600">{{ disabledCount }}</p>
            </div>
            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
          </div>
        </div>
        <div class="bg-white/80 backdrop-blur-lg rounded-xl shadow-lg p-5 border border-white/20 transform transition-all duration-200 hover:scale-105 hover:shadow-xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600 mb-1">Valor Total</p>
              <p class="text-2xl md:text-3xl font-bold text-indigo-600">Bs. {{ totalValue.toFixed(2) }}</p>
            </div>
            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
              <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
          </div>
        </div>
        <div
          @click="showContactsModal = true; fetchContacts()"
          class="bg-white/80 backdrop-blur-lg rounded-xl shadow-lg p-5 border border-white/20 transform transition-all duration-200 hover:scale-105 hover:shadow-xl cursor-pointer"
        >
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600 mb-1">Mensajes</p>
              <p class="text-2xl md:text-3xl font-bold text-amber-600">{{ unreadContactsCount }}</p>
              <p class="text-xs text-gray-500 mt-1">{{ unreadContactsCount === 1 ? 'no leído' : 'no leídos' }}</p>
            </div>
            <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center relative">
              <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
              <span v-if="unreadContactsCount > 0" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">{{ unreadContactsCount }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Barra de búsqueda y filtros -->
      <div class="bg-white/80 backdrop-blur-lg rounded-xl shadow-lg p-4 md:p-6 mb-6 border border-white/20">
        <div class="flex flex-col md:flex-row gap-4">
          <!-- Búsqueda -->
          <div class="flex-1 relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Buscar por nombre, cultivo, etapa..."
              class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white/50 hover:bg-white transition-colors"
            />
          </div>
          <!-- Filtro de estado -->
          <div class="w-full md:w-48">
            <select
              v-model="statusFilter"
              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white/50 hover:bg-white transition-colors cursor-pointer"
            >
              <option value="all">Todos los estados</option>
              <option value="enabled">Habilitados</option>
              <option value="disabled">Deshabilitados</option>
            </select>
          </div>
          <!-- Botón limpiar -->
          <button
            v-if="searchQuery || statusFilter !== 'all'"
            @click="clearFilters"
            class="px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium flex items-center gap-2"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Limpiar
          </button>
        </div>
      </div>

      <!-- Controles de paginación y elementos por página -->
      <div v-if="!loading && filteredProducts.length > 0" class="bg-white/80 backdrop-blur-lg rounded-xl shadow-lg p-4 mb-6 border border-white/20 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
          <label class="text-sm font-medium text-gray-700 whitespace-nowrap">
            Mostrar:
          </label>
          <select
            v-model="itemsPerPage"
            @change="changeItemsPerPage(parseInt($event.target.value))"
            class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white cursor-pointer text-sm"
          >
            <option v-for="num in [5, 10, 15, 20, 25, 30, 35, 40, 45, 50]" :key="num" :value="num">
              {{ num }} por página
            </option>
          </select>
          <span class="text-sm text-gray-600 hidden sm:inline">
            Mostrando {{ showingFrom }} - {{ showingTo }} de {{ filteredProducts.length }} productos
          </span>
        </div>
        <div class="text-sm text-gray-600 sm:hidden">
          {{ showingFrom }} - {{ showingTo }} de {{ filteredProducts.length }}
        </div>
      </div>

      <!-- Loading state -->
      <div v-if="loading" class="flex items-center justify-center py-20">
        <div class="text-center">
          <svg class="animate-spin h-12 w-12 text-blue-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          <p class="text-gray-600 font-medium">Cargando productos...</p>
        </div>
      </div>

      <!-- Contenedor de productos -->
      <div v-else-if="paginatedProducts.length > 0">
        <!-- Vista de cards (móvil) -->
        <div class="grid grid-cols-1 md:hidden gap-4 mb-6">
          <TransitionGroup name="list">
            <div
              v-for="product in paginatedProducts"
              :key="product.id"
              class="bg-white/80 backdrop-blur-lg rounded-xl shadow-lg p-5 border border-white/20 transform transition-all duration-200 hover:shadow-xl"
            >
              <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                  <img
                    v-if="product.foto"
                    :src="`/storage/${product.foto}`"
                    :alt="product.nombre"
                    class="h-20 w-20 object-cover rounded-lg shadow-md"
                  />
                  <div v-else class="h-20 w-20 bg-gray-200 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                  </div>
                </div>
                <div class="flex-1 min-w-0">
                  <h3 class="text-lg font-bold text-gray-900 mb-1 truncate">{{ product.nombre }}</h3>
                  <p class="text-sm text-gray-600 mb-2">{{ product.cultivo }} - {{ product.etapa }}</p>
                  <div class="flex items-center justify-between mb-3">
                    <span class="text-xl font-bold text-blue-600">${{ product.precio }}</span>
                    <span
                      :class="[
                        'px-2.5 py-1 text-xs font-semibold rounded-full',
                        (product.enabled === true || product.enabled === 1)
                          ? 'bg-green-100 text-green-800'
                          : 'bg-red-100 text-red-800',
                      ]"
                    >
                      {{ (product.enabled === true || product.enabled === 1) ? 'Habilitado' : 'Deshabilitado' }}
                    </span>
                  </div>
                  <div class="flex gap-2">
                    <button
                      @click="editProduct(product)"
                      class="flex-1 flex items-center justify-center gap-2 bg-blue-50 text-blue-600 px-3 py-2 rounded-lg hover:bg-blue-100 transition-colors font-medium text-sm"
                    >
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                      Editar
                    </button>
                    <button
                      @click="deleteProduct(product.id)"
                      class="flex-1 flex items-center justify-center gap-2 bg-red-50 text-red-600 px-3 py-2 rounded-lg hover:bg-red-100 transition-colors font-medium text-sm"
                    >
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                      Eliminar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </TransitionGroup>
        </div>

        <!-- Vista de tabla (desktop) -->
        <div class="bg-white/80 backdrop-blur-lg rounded-xl shadow-lg overflow-hidden border border-white/20 hidden md:block">
        <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100/50">
              <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Foto</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Precio</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Dosis</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Cultivo</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Etapa</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Estado</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Acciones</th>
            </tr>
          </thead>
            <TransitionGroup name="table-row" tag="tbody" class="bg-white divide-y divide-gray-200">
                <tr
                  v-for="product in paginatedProducts"
                  :key="product.id"
                  class="hover:bg-blue-50/50 transition-colors duration-150"
                >
              <td class="px-6 py-4 whitespace-nowrap">
                <img
                  v-if="product.foto"
                  :src="`/storage/${product.foto}`"
                      :alt="product.nombre"
                      class="h-16 w-16 object-cover rounded-lg shadow-md"
                    />
                    <div v-else class="h-16 w-16 bg-gray-200 rounded-lg flex items-center justify-center">
                      <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                    </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-semibold text-gray-900">{{ product.nombre }}</div>
                    <div v-if="product.descripcion" class="text-xs text-gray-500 mt-1 line-clamp-1">{{ product.descripcion }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-bold text-blue-600">${{ product.precio }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ product.dosis }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ product.cultivo }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ product.etapa }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span
                  :class="[
                        'px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full',
                        (product.enabled === true || product.enabled === 1)
                      ? 'bg-green-100 text-green-800'
                      : 'bg-red-100 text-red-800',
                  ]"
                >
                      {{ (product.enabled === true || product.enabled === 1) ? 'Habilitado' : 'Deshabilitado' }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex items-center gap-3">
                <button
                  @click="editProduct(product)"
                        class="text-blue-600 hover:text-blue-800 transition-colors flex items-center gap-1 group"
                        title="Editar"
                >
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span class="hidden lg:inline">Editar</span>
                </button>
                <button
                  @click="deleteProduct(product.id)"
                        class="text-red-600 hover:text-red-800 transition-colors flex items-center gap-1 group"
                        title="Eliminar"
                >
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span class="hidden lg:inline">Eliminar</span>
                </button>
                    </div>
              </td>
            </tr>
            </TransitionGroup>
        </table>
        </div>
        </div>
      </div>

      <!-- Paginación -->
      <div v-if="!loading && filteredProducts.length > 0 && totalPages > 1" class="bg-white/80 backdrop-blur-lg rounded-xl shadow-lg p-4 mb-6 border border-white/20">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
          <div class="text-sm text-gray-600">
            Página {{ currentPage }} de {{ totalPages }}
          </div>
          <div class="flex items-center gap-2">
            <button
              @click="goToPage(currentPage - 1)"
              :disabled="currentPage === 1"
              class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors flex items-center gap-2"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
              Anterior
            </button>

            <div class="flex items-center gap-1">
              <template v-for="page in visiblePages" :key="page">
                <button
                  v-if="page !== '...'"
                  @click="goToPage(page)"
                  :class="[
                    'px-3 py-2 rounded-lg transition-colors min-w-[40px]',
                    page === currentPage
                      ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold shadow-md'
                      : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50'
                  ]"
                >
                  {{ page }}
                </button>
                <span v-else class="px-2 text-gray-400">...</span>
              </template>
            </div>

            <button
              @click="goToPage(currentPage + 1)"
              :disabled="currentPage === totalPages"
              class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors flex items-center gap-2"
            >
              Siguiente
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Estado vacío -->
      <div v-if="!loading && paginatedProducts.length === 0" class="bg-white/80 backdrop-blur-lg rounded-xl shadow-lg p-12 text-center border border-white/20">
        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
        </svg>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">
          {{ searchQuery || statusFilter !== 'all' ? 'No se encontraron productos' : 'No hay productos registrados' }}
        </h3>
        <p class="text-gray-600 mb-6">
          {{ searchQuery || statusFilter !== 'all' ? 'Intenta con otros términos de búsqueda o filtros' : 'Comienza agregando tu primer producto' }}
        </p>
        <button
          v-if="!searchQuery && statusFilter === 'all'"
          @click="showCreateModal = true"
          class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transform transition-all duration-200 hover:scale-105"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Crear Primer Producto
        </button>
      </div>

      <!-- Modal de creación/edición -->
      <Transition name="modal">
      <div
        v-if="showCreateModal || showEditModal"
          class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4"
        @click.self="closeModal"
      >
          <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto transform transition-all">
            <!-- Header del modal -->
            <div class="sticky top-0 bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6 rounded-t-2xl flex items-center justify-between">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                  </svg>
                </div>
                <h3 class="text-xl font-bold">
              {{ showEditModal ? 'Editar Producto' : 'Nuevo Producto' }}
            </h3>
              </div>
              <button
                @click="closeModal"
                class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-white/20 transition-colors"
              >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>

            <!-- Contenido del modal -->
            <form @submit.prevent="saveProduct" class="p-6 space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                  <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nombre del Producto <span class="text-red-500">*</span>
                  </label>
                  <input
                    v-model="form.nombre"
                    type="text"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white"
                    placeholder="Ej: Fertilizante Premium"
                  />
                </div>

                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Precio
                  </label>
                  <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Bs.</span>
                  <input
                    v-model="form.precio"
                    type="number"
                    step="0.01"
                    min="0"
                      class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white"
                      placeholder="0.00"
                  />
                  </div>
                </div>

                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Dosis
                  </label>
                  <input
                    v-model="form.dosis"
                    type="text"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white"
                    placeholder="Ej: 2kg/ha"
                  />
                </div>

                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Cultivo
                  </label>
                  <input
                    v-model="form.cultivo"
                    type="text"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white"
                    placeholder="Ej: Maíz"
                  />
                </div>

                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Etapa
                  </label>
                  <input
                    v-model="form.etapa"
                    type="text"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white"
                    placeholder="Ej: Crecimiento"
                  />
                </div>

                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Estado
                  </label>
                  <select
                    v-model="form.enabled"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white cursor-pointer"
                  >
                    <option :value="true">Habilitado</option>
                    <option :value="false">Deshabilitado</option>
                  </select>
                </div>
              </div>

              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                  Descripción
                </label>
                <textarea
                  v-model="form.descripcion"
                  rows="4"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white resize-none"
                  placeholder="Descripción detallada del producto..."
                ></textarea>
              </div>

              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                  Foto del Producto
                  <span class="text-gray-500 text-xs font-normal ml-2">(Máximo 25MB - Se comprimirá automáticamente a 800px máximo)</span>
                </label>
                <div class="mt-2">
                  <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                      <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                      </svg>
                      <p class="mb-2 text-sm text-gray-500">
                        <span class="font-semibold">Click para subir</span> o arrastra y suelta
                      </p>
                      <p class="text-xs text-gray-500">PNG, JPG, GIF o WEBP (MAX. 10MB)</p>
                    </div>
                <input
                  type="file"
                  accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                  @change="handleFileChange"
                      class="hidden"
                />
                  </label>
                </div>
                <div v-if="form.fotoPreview" class="mt-4">
                  <img
                    :src="form.fotoPreview"
                    alt="Vista previa"
                    class="h-32 w-32 object-cover rounded-lg shadow-md border-2 border-gray-200"
                  />
                  <button
                    type="button"
                    @click="removeImage"
                    class="mt-2 text-sm text-red-600 hover:text-red-800 font-medium"
                  >
                    Eliminar imagen
                  </button>
                </div>
              </div>

              <!-- Botones del modal -->
              <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <button
                  type="button"
                  @click="closeModal"
                  class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold"
                >
                  Cancelar
                </button>
                <button
                  type="submit"
                  :disabled="saving"
                  class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transform transition-all duration-200 hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none font-semibold flex items-center gap-2"
                >
                  <svg v-if="saving" class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  <span v-if="saving">Guardando...</span>
                  <span v-else>{{ showEditModal ? 'Actualizar' : 'Crear' }} Producto</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </Transition>

      <!-- Modal de Contactos -->
      <Transition name="fade">
        <div
          v-if="showContactsModal"
          class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4"
          @click.self="showContactsModal = false"
        >
          <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto transform transition-all">
            <!-- Header del modal -->
            <div class="sticky top-0 bg-gradient-to-r from-amber-500 to-amber-600 text-white p-6 rounded-t-2xl flex items-center justify-between">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
      </div>
                <h3 class="text-xl font-bold">
                  Mensajes de Contacto
                </h3>
                <span v-if="unreadContactsCount > 0" class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                  {{ unreadContactsCount }} {{ unreadContactsCount === 1 ? 'no leído' : 'no leídos' }}
                </span>
              </div>
              <button
                @click="showContactsModal = false"
                class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-white/20 transition-colors"
              >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>

            <!-- Contenido del modal -->
            <div class="p-6">
              <div v-if="loadingContacts" class="text-center py-12">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-amber-600"></div>
                <p class="mt-4 text-gray-600">Cargando mensajes...</p>
              </div>
              <div v-else-if="contacts.length === 0" class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <p class="mt-4 text-gray-600 font-medium">No hay mensajes de contacto</p>
              </div>
              <div v-else class="space-y-4">
                <div
                  v-for="contact in contacts"
                  :key="contact.id"
                  :class="[
                    'border rounded-xl p-5 transition-all',
                    contact.read ? 'bg-gray-50 border-gray-200' : 'bg-amber-50 border-amber-300 shadow-md'
                  ]"
                >
                  <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                      <div class="flex items-center gap-3 mb-2">
                        <h4 class="text-lg font-bold text-gray-900">{{ contact.name }}</h4>
                        <span v-if="!contact.read" class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                          Nuevo
                        </span>
                      </div>
                      <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                        <div class="flex items-center gap-1">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                          </svg>
                          <a :href="`mailto:${contact.email}`" class="hover:text-amber-600 transition-colors">{{ contact.email }}</a>
                        </div>
                        <div v-if="contact.phone" class="flex items-center gap-1">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                          </svg>
                          <a :href="`tel:${contact.phone}`" class="hover:text-amber-600 transition-colors">{{ contact.phone }}</a>
                        </div>
                        <div class="flex items-center gap-1">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                          <span>{{ new Date(contact.created_at).toLocaleString('es-ES') }}</span>
                        </div>
                      </div>
                    </div>
                    <button
                      v-if="!contact.read"
                      @click="markAsRead(contact.id)"
                      class="ml-4 px-3 py-1.5 bg-amber-600 text-white text-sm font-medium rounded-lg hover:bg-amber-700 transition-colors"
                    >
                      Marcar como leído
                    </button>
                  </div>
                  <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <p class="text-gray-700 whitespace-pre-wrap">{{ contact.message }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </Transition>
    </div>
  </div>
</template>

<script>
import { ref, reactive, onMounted, computed, watch } from 'vue';
import axios from 'axios';
import { useToast } from '../composables/useToast';

export default {
  name: 'Products',
  emits: ['logout'],
  setup(_props, { emit }) {
    const toast = useToast();
    const products = ref([]);
    const loading = ref(false);
    const saving = ref(false);
    const showCreateModal = ref(false);
    const showEditModal = ref(false);
    const showContactsModal = ref(false);
    const editingId = ref(null);
    const searchQuery = ref('');
    const statusFilter = ref('all');
    const currentPage = ref(1);
    const itemsPerPage = ref(10);
    const contacts = ref([]);
    const loadingContacts = ref(false);
    const unreadContactsCount = ref(0);

    const form = reactive({
      nombre: '',
      precio: 0,
      dosis: '',
      descripcion: '',
      cultivo: '',
      etapa: '',
      enabled: true,
      foto: null,
      fotoPreview: null,
    });

    // Computed properties
    const enabledCount = computed(() => products.value.filter(p => p.enabled === true || p.enabled === 1).length);
    const disabledCount = computed(() => products.value.filter(p => p.enabled === false || p.enabled === 0).length);
    const totalValue = computed(() => products.value.reduce((sum, p) => sum + parseFloat(p.precio || 0), 0));

    const filteredProducts = computed(() => {
      let filtered = [...products.value];

      // Filtrar por estado
      if (statusFilter.value === 'enabled') {
        filtered = filtered.filter(p => p.enabled === true || p.enabled === 1);
      } else if (statusFilter.value === 'disabled') {
        filtered = filtered.filter(p => p.enabled === false || p.enabled === 0);
      }

      // Filtrar por búsqueda
      if (searchQuery.value.trim()) {
        const query = searchQuery.value.toLowerCase().trim();
        filtered = filtered.filter(p => {
          const nombre = (p.nombre || '').toLowerCase();
          const cultivo = (p.cultivo || '').toLowerCase();
          const etapa = (p.etapa || '').toLowerCase();
          const dosis = (p.dosis || '').toLowerCase();
          const descripcion = (p.descripcion || '').toLowerCase();

          return nombre.includes(query) ||
                 cultivo.includes(query) ||
                 etapa.includes(query) ||
                 dosis.includes(query) ||
                 descripcion.includes(query);
        });
      }

      return filtered;
    });

    // Paginación
    const totalPages = computed(() => {
      return Math.ceil(filteredProducts.value.length / itemsPerPage.value);
    });

    const paginatedProducts = computed(() => {
      const start = (currentPage.value - 1) * itemsPerPage.value;
      const end = start + itemsPerPage.value;
      return filteredProducts.value.slice(start, end);
    });

    const showingFrom = computed(() => {
      if (filteredProducts.value.length === 0) return 0;
      return (currentPage.value - 1) * itemsPerPage.value + 1;
    });

    const showingTo = computed(() => {
      const end = currentPage.value * itemsPerPage.value;
      return Math.min(end, filteredProducts.value.length);
    });

    const fetchProducts = async () => {
      loading.value = true;
      try {
        const response = await axios.get('/api/products', {
          withCredentials: true,
        });
        products.value = response.data;
      } catch (error) {
        console.error('Error al cargar productos:', error);
        toast.error('Error al cargar los productos. Por favor, recarga la página.');
      } finally {
        loading.value = false;
      }
    };

    // Función para comprimir imagen usando Canvas API
    const compressImage = (file, maxWidth = 1920, maxHeight = 1920, quality = 0.8, maxSizeMB = 5) => {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        
        reader.onload = (e) => {
          const img = new Image();
          
          img.onload = () => {
            // Calcular nuevas dimensiones manteniendo proporción
            let width = img.width;
            let height = img.height;
            
            if (width > maxWidth || height > maxHeight) {
              const ratio = Math.min(maxWidth / width, maxHeight / height);
              width = width * ratio;
              height = height * ratio;
            }
            
            // Crear canvas
            const canvas = document.createElement('canvas');
            canvas.width = width;
            canvas.height = height;
            
            const ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, width, height);
            
            // Convertir a blob con compresión
            canvas.toBlob(
              (blob) => {
                if (!blob) {
                  reject(new Error('Error al comprimir la imagen'));
                  return;
                }
                
                // Si el blob es muy grande, reducir más la calidad
                const blobSizeMB = blob.size / (1024 * 1024);
                if (blobSizeMB > maxSizeMB) {
                  // Reducir calidad y volver a comprimir
                  canvas.toBlob(
                    (smallerBlob) => {
                      if (!smallerBlob) {
                        reject(new Error('Error al comprimir la imagen'));
                        return;
                      }
                      resolve(smallerBlob);
                    },
                    'image/jpeg',
                    Math.max(0.5, quality * 0.7) // Reducir calidad
                  );
                } else {
                  resolve(blob);
                }
              },
              'image/jpeg',
              quality
            );
          };
          
          img.onerror = () => {
            reject(new Error('Error al cargar la imagen'));
          };
          
          img.src = e.target.result;
        };
        
        reader.onerror = () => {
          reject(new Error('Error al leer el archivo'));
        };
        
        reader.readAsDataURL(file);
      });
    };

    const handleFileChange = async (event) => {
      const file = event.target.files[0];
      if (!file) return;

      // Validar tamaño (25MB = 26214400 bytes)
      const maxSize = 25 * 1024 * 1024;
      if (file.size > maxSize) {
        toast.error('La imagen no puede exceder 25MB de tamaño.');
        event.target.value = '';
        return;
      }

      // Validar tipo de archivo
      const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
      if (!allowedTypes.includes(file.type)) {
        toast.error('El archivo debe ser una imagen válida (JPEG, PNG, JPG, GIF o WEBP).');
        event.target.value = '';
        return;
      }

      try {
        // Mostrar advertencia si la imagen es grande
        if (file.size > 2 * 1024 * 1024) {
          const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
          toast.warning(`Comprimiendo imagen grande (${sizeMB}MB)...`);
        }

        // Comprimir imagen si es mayor a 2MB
        let processedFile = file;
        if (file.size > 2 * 1024 * 1024) {
          try {
            processedFile = await compressImage(file, 1920, 1920, 0.85, 5);
            const originalSizeMB = (file.size / (1024 * 1024)).toFixed(2);
            const compressedSizeMB = (processedFile.size / (1024 * 1024)).toFixed(2);
            toast.success(`Imagen comprimida: ${originalSizeMB}MB → ${compressedSizeMB}MB`);
          } catch (compressError) {
            console.error('Error al comprimir:', compressError);
            toast.warning('No se pudo comprimir la imagen. Se enviará la imagen original.');
            processedFile = file;
          }
        }

        form.foto = processedFile;
        
        // Mostrar preview
        const reader = new FileReader();
        reader.onload = (e) => {
          form.fotoPreview = e.target.result;
        };
        reader.onerror = () => {
          toast.error('Error al leer la imagen. Por favor, intenta con otra imagen.');
          event.target.value = '';
        };
        reader.readAsDataURL(processedFile);
        
        if (file.size <= 2 * 1024 * 1024) {
          toast.success('Imagen seleccionada correctamente.');
        }
      } catch (error) {
        console.error('Error al procesar imagen:', error);
        toast.error('Error al procesar la imagen. Por favor, intenta con otra imagen.');
        event.target.value = '';
      }
    };

    const removeImage = () => {
      form.foto = null;
      form.fotoPreview = null;
    };

    const clearFilters = () => {
      searchQuery.value = '';
      statusFilter.value = 'all';
      currentPage.value = 1;
    };

    const goToPage = (page) => {
      if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    };

    const changeItemsPerPage = (newItemsPerPage) => {
      itemsPerPage.value = newItemsPerPage;
      currentPage.value = 1;
    };

    // Observar cambios en filtros para resetear página
    watch([searchQuery, statusFilter], () => {
      currentPage.value = 1;
    });

    const resetForm = () => {
      form.nombre = '';
      form.precio = 0;
      form.dosis = '';
      form.descripcion = '';
      form.cultivo = '';
      form.etapa = '';
      form.enabled = true;
      form.foto = null;
      form.fotoPreview = null;
      editingId.value = null;
    };

    const closeModal = () => {
      showCreateModal.value = false;
      showEditModal.value = false;
      resetForm();
    };

    const editProduct = (product) => {
      editingId.value = product.id;
      form.nombre = product.nombre || '';
      form.precio = product.precio !== null && product.precio !== undefined ? product.precio : 0;
      form.dosis = product.dosis || '';
      form.descripcion = product.descripcion || '';
      form.cultivo = product.cultivo || '';
      form.etapa = product.etapa || '';
      form.enabled = product.enabled;
      if (product.foto) {
        form.fotoPreview = `/storage/${product.foto}`;
      }
      form.foto = null;
      showEditModal.value = true;
    };

    const validateForm = () => {
      // Solo el nombre es obligatorio
      if (!form.nombre || form.nombre.trim() === '') {
        toast.warning('El nombre del producto es obligatorio.');
        return false;
      }
      // Validar precio solo si se proporciona (debe ser un número válido >= 0)
      if (form.precio !== '' && form.precio !== null && (isNaN(parseFloat(form.precio)) || parseFloat(form.precio) < 0)) {
        toast.warning('El precio debe ser un número válido mayor o igual a 0.');
        return false;
      }
      return true;
    };

    const saveProduct = async () => {
      if (!validateForm()) {
        return;
      }

      saving.value = true;
      try {
        const formData = new FormData();
        formData.append('nombre', form.nombre.trim());
        
        // Precio: usar 0 si está vacío o null, de lo contrario usar el valor parseado
        const precio = form.precio === '' || form.precio === null ? 0 : parseFloat(form.precio);
        formData.append('precio', precio);
        
        // Campos opcionales: solo agregar si tienen valor
        if (form.dosis && form.dosis.trim() !== '') {
          formData.append('dosis', form.dosis.trim());
        }
        if (form.descripcion && form.descripcion.trim() !== '') {
          formData.append('descripcion', form.descripcion.trim());
        }
        if (form.cultivo && form.cultivo.trim() !== '') {
          formData.append('cultivo', form.cultivo.trim());
        }
        if (form.etapa && form.etapa.trim() !== '') {
          formData.append('etapa', form.etapa.trim());
        }
        
        formData.append('enabled', form.enabled ? '1' : '0');
        if (form.foto) {
          formData.append('foto', form.foto);
        }

        // Mostrar advertencia si hay una imagen grande siendo procesada
        if (form.foto && form.foto.size > 5 * 1024 * 1024) {
          toast.warning('Procesando imagen grande. Esto puede tardar unos momentos...');
        }

        if (editingId.value) {
          // Usar POST con _method spoofing para mayor compatibilidad con FormData
          // Laravel procesará el _method en el FormData
          formData.append('_method', 'PUT');
          const response = await axios.post(`/api/products/${editingId.value}`, formData, {
            withCredentials: true,
            onUploadProgress: (progressEvent) => {
              if (form.foto && form.foto.size > 5 * 1024 * 1024) {
                const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                // Solo mostrar progreso cada 25% para no saturar
                if (percentCompleted % 25 === 0 || percentCompleted === 100) {
                  console.log(`Subiendo imagen: ${percentCompleted}%`);
                }
              }
            },
          });
          toast.success(response.data.message || 'Producto actualizado exitosamente.');
        } else {
          const response = await axios.post('/api/products', formData, {
            withCredentials: true,
            onUploadProgress: (progressEvent) => {
              if (form.foto && form.foto.size > 5 * 1024 * 1024) {
                const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                // Solo mostrar progreso cada 25% para no saturar
                if (percentCompleted % 25 === 0 || percentCompleted === 100) {
                  console.log(`Subiendo imagen: ${percentCompleted}%`);
                }
              }
            },
          });
          toast.success(response.data.message || 'Producto creado exitosamente.');
        }

        await fetchProducts();
        closeModal();
      } catch (error) {
        console.error('Error al guardar producto:', error);
        
        // Manejar diferentes tipos de errores
        if (error.response) {
          const status = error.response.status;
          const data = error.response.data;
          
          if (status === 422 && data.errors) {
            // Errores de validación
            const errors = data.errors;
            Object.keys(errors).forEach((field) => {
              errors[field].forEach((message) => {
                toast.error(message);
              });
            });
          } else if (status === 413) {
            // Error de tamaño de archivo (Request Entity Too Large)
            toast.error('La imagen es demasiado grande. Por favor, comprime la imagen antes de subirla o intenta con una imagen más pequeña.');
          } else if (data && data.message) {
            // Verificar si el mensaje contiene información sobre POST demasiado grande
            const errorMessage = data.message.toLowerCase();
            if (errorMessage.includes('post') && (errorMessage.includes('too large') || errorMessage.includes('too big') || errorMessage.includes('exceeds'))) {
              toast.error('La imagen es demasiado grande para enviar. Por favor, comprime la imagen antes de subirla. La imagen debería comprimirse automáticamente, pero si el problema persiste, intenta con una imagen más pequeña.');
            } else {
              toast.error(data.message);
            }
          } else {
            toast.error('Error al guardar el producto. Por favor, intenta de nuevo.');
          }
        } else if (error.request) {
          // Error de red o timeout
          if (error.code === 'ECONNABORTED' || error.message?.includes('timeout')) {
            toast.error('La operación está tardando demasiado. Por favor, intenta con una imagen más pequeña o verifica tu conexión.');
          } else {
            toast.error('Error de conexión. Por favor, verifica tu conexión a internet e intenta de nuevo.');
          }
        } else if (error.message) {
          // Error con mensaje específico
          const errorMsg = error.message.toLowerCase();
          if (errorMsg.includes('network') || errorMsg.includes('fetch')) {
            toast.error('Error de conexión. Por favor, verifica tu conexión a internet e intenta de nuevo.');
          } else if (errorMsg.includes('size') || errorMsg.includes('large') || errorMsg.includes('big')) {
            toast.error('La imagen es demasiado grande. Por favor, intenta con una imagen más pequeña.');
          } else {
            toast.error(`Error: ${error.message}`);
          }
        } else {
          // Error desconocido
          toast.error('Error inesperado. Por favor, intenta de nuevo. Si el problema persiste, verifica que la imagen no sea demasiado grande.');
        }
      } finally {
        saving.value = false;
      }
    };

    const deleteProduct = async (id) => {
      if (!confirm('¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.')) {
        return;
      }

      try {
        const response = await axios.delete(`/api/products/${id}`, {
          withCredentials: true,
        });
        toast.success(response.data.message || 'Producto eliminado exitosamente.');
        await fetchProducts();
      } catch (error) {
        console.error('Error al eliminar producto:', error);
        if (error.response && error.response.data) {
          toast.error(error.response.data.message || 'Error al eliminar el producto.');
        } else {
          toast.error('Error de conexión. Por favor, intenta de nuevo.');
        }
      }
    };

    const handleLogout = async () => {
      try {
        await axios.post('/api/logout', {}, {
          withCredentials: true,
        });
        toast.success('Sesión cerrada exitosamente.');
        emit('logout');
      } catch (error) {
        console.error('Error al cerrar sesión:', error);
        toast.warning('Se cerró la sesión localmente.');
        emit('logout');
      }
    };

    // Páginas visibles para la paginación
    const visiblePages = computed(() => {
      const pages = [];
      const total = totalPages.value;
      const current = currentPage.value;

      if (total <= 7) {
        // Si hay 7 o menos páginas, mostrar todas
        for (let i = 1; i <= total; i++) {
          pages.push(i);
        }
      } else {
        // Mostrar primera página
        pages.push(1);

        if (current > 3) {
          pages.push('...');
        }

        // Mostrar páginas alrededor de la actual
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

        // Mostrar última página
        if (total > 1) {
          pages.push(total);
        }
      }

      return pages;
    });

    const fetchContacts = async () => {
      loadingContacts.value = true;
      try {
        const response = await axios.get('/api/contacts', {
          withCredentials: true,
        });
        contacts.value = response.data;
        updateUnreadCount();
      } catch (error) {
        console.error('Error al cargar contactos:', error);
        toast.error('Error al cargar los mensajes de contacto.');
      } finally {
        loadingContacts.value = false;
      }
    };

    const updateUnreadCount = async () => {
      try {
        const response = await axios.get('/api/contacts/unread-count', {
          withCredentials: true,
        });
        unreadContactsCount.value = response.data.count || 0;
      } catch (error) {
        console.error('Error al obtener contador de no leídos:', error);
      }
    };

    const markAsRead = async (id) => {
      try {
        await axios.put(`/api/contacts/${id}/read`, {}, {
          withCredentials: true,
        });
        const contact = contacts.value.find(c => c.id === id);
        if (contact) {
          contact.read = true;
        }
        updateUnreadCount();
        toast.success('Mensaje marcado como leído.');
      } catch (error) {
        console.error('Error al marcar como leído:', error);
        toast.error('Error al actualizar el mensaje.');
      }
    };

    onMounted(() => {
      fetchProducts();
      updateUnreadCount();
      // Actualizar contador cada 30 segundos
      setInterval(updateUnreadCount, 30000);
    });

    return {
      products,
      loading,
      saving,
      showCreateModal,
      showEditModal,
      showContactsModal,
      form,
      searchQuery,
      statusFilter,
      filteredProducts,
      paginatedProducts,
      currentPage,
      itemsPerPage,
      totalPages,
      visiblePages,
      showingFrom,
      showingTo,
      enabledCount,
      disabledCount,
      totalValue,
      contacts,
      loadingContacts,
      unreadContactsCount,
      handleFileChange,
      removeImage,
      clearFilters,
      goToPage,
      changeItemsPerPage,
      closeModal,
      editProduct,
      saveProduct,
      fetchContacts,
      markAsRead,
      deleteProduct,
      handleLogout,
    };
  },
};
</script>

<style scoped>
/* Animaciones para la lista */
.list-enter-active,
.list-leave-active {
  transition: all 0.3s ease;
}

.list-enter-from {
  opacity: 0;
  transform: translateY(20px);
}

.list-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}

.list-move {
  transition: transform 0.3s ease;
}

/* Animaciones para filas de tabla */
.table-row-enter-active,
.table-row-leave-active {
  transition: all 0.3s ease;
}

.table-row-enter-from {
  opacity: 0;
  transform: translateX(-20px);
}

.table-row-leave-to {
  opacity: 0;
  transform: translateX(20px);
}

.table-row-move {
  transition: transform 0.3s ease;
}

/* Animaciones para modal */
.modal-enter-active,
.modal-leave-active {
  transition: all 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}

.modal-enter-from .bg-white,
.modal-leave-to .bg-white {
  transform: scale(0.9) translateY(-20px);
}

/* Utilidad para truncar texto */
.line-clamp-1 {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
