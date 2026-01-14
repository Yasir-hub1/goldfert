<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-green-50/30 to-amber-50/20">
        <!-- Header -->
        <div class="bg-white/80 backdrop-blur-lg shadow-sm border-b border-gray-200/50 sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
                <button
                    @click="$emit('back')"
                    class="flex items-center gap-2 text-green-700 hover:text-green-800 transition-colors p-2 hover:bg-green-50 rounded-lg"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="font-semibold">Volver al Catálogo</span>
                </button>
            </div>
        </div>

        <!-- Loading -->
        <div v-if="loading" class="flex justify-center items-center py-20">
            <div class="text-center">
                <svg class="animate-spin h-12 w-12 text-green-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="text-gray-600 font-medium">Cargando producto...</p>
            </div>
        </div>

        <!-- Contenido del producto -->
        <div v-else-if="product" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden border border-white/20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    <!-- Imagen del producto -->
                    <div class="relative h-80 sm:h-96 lg:h-full lg:min-h-[600px] bg-gradient-to-br from-gray-100 to-gray-200" data-aos="fade-right">
                        <img
                            v-if="product.foto"
                            :src="product.foto"
                            :alt="product.nombre"
                            class="w-full h-full object-cover"
                        />
                        <div v-else class="w-full h-full flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <!-- Badge de precio flotante -->
                        <div class="absolute top-4 right-4 bg-gradient-to-r from-amber-500 to-amber-600 text-white px-5 py-3 rounded-xl shadow-2xl">
                            <div class="text-xs font-medium opacity-90 mb-1">Precio</div>
                            <div class="text-2xl sm:text-3xl font-bold">Bs. {{ formatPrice(product.precio) }}</div>
                        </div>
                    </div>

                    <!-- Información del producto -->
                    <div class="p-6 sm:p-8 lg:p-12 flex flex-col justify-between" data-aos="fade-left">
                        <div>
                            <!-- Categorías -->
                            <div class="flex flex-wrap gap-2 sm:gap-3 mb-4 sm:mb-6">
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-green-100 text-green-700 rounded-full font-semibold text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ product.cultivo }}
                                </span>
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-blue-100 text-blue-700 rounded-full font-semibold text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ product.etapa }}
                                </span>
                            </div>

                            <!-- Título -->
                            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 sm:mb-6 font-display leading-tight">
                                {{ product.nombre }}
                            </h1>

                            <!-- Descripción -->
                            <div class="mb-6 sm:mb-8">
                                <p class="text-gray-700 leading-relaxed text-base sm:text-lg">
                                    {{ product.descripcion || 'Sin descripción disponible.' }}
                                </p>
                            </div>

                            <!-- Información técnica -->
                            <div class="space-y-4 mb-6 sm:mb-8">
                                <!-- Dosis -->
                                <div class="flex items-start gap-4 p-4 sm:p-5 bg-amber-50 rounded-xl border-l-4 border-amber-500">
                                    <div class="flex-shrink-0">
                                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 mb-1 text-sm sm:text-base">Dosis Recomendada</h3>
                                        <p class="text-gray-700 text-sm sm:text-base">{{ product.dosis }}</p>
                                    </div>
                                </div>

                                <!-- Cultivo -->
                                <div class="flex items-start gap-4 p-4 sm:p-5 bg-green-50 rounded-xl border-l-4 border-green-500">
                                    <div class="flex-shrink-0">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 mb-1 text-sm sm:text-base">Tipo de Cultivo</h3>
                                        <p class="text-gray-700 text-sm sm:text-base">{{ product.cultivo }}</p>
                                    </div>
                                </div>

                                <!-- Etapa -->
                                <div class="flex items-start gap-4 p-4 sm:p-5 bg-blue-50 rounded-xl border-l-4 border-blue-500">
                                    <div class="flex-shrink-0">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 mb-1 text-sm sm:text-base">Etapa de Aplicación</h3>
                                        <p class="text-gray-700 text-sm sm:text-base">{{ product.etapa }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-4 border-t border-gray-200">
                            <a
                                :href="whatsappLink"
                                target="_blank"
                                class="flex-1 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-3.5 px-6 rounded-xl transition-all transform hover:scale-105 flex items-center justify-center gap-2 shadow-lg"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                                <span>Consultar por WhatsApp</span>
                            </a>
                            <button
                                @click="$emit('back')"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-900 font-bold py-3.5 px-6 rounded-xl transition-all flex items-center justify-center gap-2 border border-gray-300"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                <span>Volver</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de asesoría -->
            <div class="mt-8 sm:mt-12" data-aos="fade-up">
                <div class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-2xl p-6 sm:p-8 lg:p-10 text-center shadow-xl">
                    <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-4 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <h3 class="text-xl sm:text-2xl font-bold mb-2">Asesoría Personalizada</h3>
                    <p class="text-green-100 mb-6 text-sm sm:text-base">Nuestro equipo de expertos está listo para ayudarte a elegir el mejor producto para tu cultivo</p>
                    <a
                        href="#contacto"
                        @click="$emit('go-home')"
                        class="inline-flex items-center gap-2 bg-white text-green-700 font-bold py-3 px-6 sm:px-8 rounded-xl hover:bg-green-50 transition-all transform hover:scale-105 shadow-lg"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Contactar Ahora</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Error -->
        <div v-else class="max-w-2xl mx-auto px-4 py-20 text-center">
            <svg class="w-16 h-16 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Producto no encontrado</h2>
            <button
                @click="$emit('back')"
                class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-3 px-6 rounded-xl transition-all transform hover:scale-105 shadow-lg"
            >
                Volver al catálogo
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ProductDetail',
    props: {
        productId: {
            type: [Number, String],
            required: true
        }
    },
    data() {
        return {
            product: null,
            loading: true
        }
    },
    computed: {
        whatsappLink() {
            if (!this.product) return '#';
            const phone = '+59171616724';
            const message = `Hola, me interesa el producto *${this.product.nombre}* (${this.product.cultivo}) - Bs. ${this.formatPrice(this.product.precio)}`;
            return `https://wa.me/${phone.replace(/\D/g, '')}?text=${encodeURIComponent(message)}`;
        }
    },
    mounted() {
        this.fetchProduct();

        // Inicializar AOS
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                once: true
            });
        }
    },
    methods: {
        async fetchProduct() {
            try {
                this.loading = true;
                const response = await axios.get(`/api/public/products/${this.productId}`);
                this.product = response.data;
            } catch (error) {
                console.error('Error al cargar el producto:', error);
                this.product = null;
            } finally {
                this.loading = false;
            }
        },
        formatPrice(price) {
            return parseFloat(price).toFixed(2);
        }
    }
}
</script>

<style scoped>
/* Estilos adicionales si son necesarios */
</style>
