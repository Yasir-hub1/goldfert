<template>
    <div>
        <!-- Navbar -->
        <nav class="sticky top-0 z-50 bg-white dark:bg-gray-800 shadow-md transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="#inicio" class="flex items-center">
                                <img src="/images/logo.png"
                                     alt="GOLDfert Fertilizantes"
                                     class="h-12 w-auto object-contain">
                            </a>
                        </div>
                    </div>

                    <div class="hidden md:flex items-center space-x-8">
                        <a class="font-semibold text-green-700 dark:text-green-400 border-b-2 border-green-700 dark:border-green-400 transition" href="#inicio">Inicio</a>
                        <a class="font-medium text-gray-600 dark:text-gray-300 hover:text-green-700 dark:hover:text-green-400 transition" href="/productos" @click.prevent="$emit('show-products')">Productos</a>
                        <a class="font-medium text-gray-600 dark:text-gray-300 hover:text-green-700 dark:hover:text-green-400 transition" href="#soluciones">Soluciones Agrícolas</a>
                        <a class="font-medium text-gray-600 dark:text-gray-300 hover:text-green-700 dark:hover:text-green-400 transition" href="#nosotros">Nosotros</a>
                        <a class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-6 rounded-md shadow-lg transition transform hover:-translate-y-0.5" href="#contacto">
                            Contacto
                        </a>
                    </div>

                    <div class="flex items-center md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-500 dark:text-gray-200 hover:text-gray-600 focus:outline-none p-2" type="button" aria-label="Abrir menú">
                            <span class="material-icons-outlined text-3xl">menu</span>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Mobile Menu Overlay -->
        <Transition name="fade">
            <div
                v-if="mobileMenuOpen"
                @click="mobileMenuOpen = false"
                class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 md:hidden"
                aria-hidden="true"
            ></div>
        </Transition>

        <!-- Mobile Menu Drawer -->
        <Transition name="slide">
            <div
                v-if="mobileMenuOpen"
                class="fixed top-0 right-0 bottom-0 w-80 max-w-[85vw] bg-white dark:bg-gray-800 shadow-2xl z-50 md:hidden overflow-y-auto"
            >
                <!-- Header del menú móvil -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <a href="#inicio" @click="closeMenu" class="flex items-center">
                            <img src="/images/logo.png"
                                 alt="GOLDfert Fertilizantes"
                                 class="h-10 w-auto object-contain">
                        </a>
                    </div>
                    <button
                        @click="mobileMenuOpen = false"
                        class="text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white transition p-2"
                        aria-label="Cerrar menú"
                    >
                        <span class="material-icons-outlined text-3xl">close</span>
                    </button>
                </div>

                <!-- Links del menú -->
                <nav class="py-6 px-4">
                    <a
                        @click="closeMenu"
                        href="#inicio"
                        class="flex items-center gap-4 px-4 py-4 text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-green-900/20 rounded-lg transition-colors mb-2 group"
                    >
                        <span class="material-icons-outlined text-green-700 dark:text-green-400 group-hover:scale-110 transition-transform">home</span>
                        <span class="font-semibold text-lg">Inicio</span>
                    </a>

                    <a
                        @click="closeMenu; $emit('show-products')"
                        href="/productos"
                        class="flex items-center gap-4 px-4 py-4 text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-green-900/20 rounded-lg transition-colors mb-2 group"
                    >
                        <span class="material-icons-outlined text-green-700 dark:text-green-400 group-hover:scale-110 transition-transform">inventory_2</span>
                        <span class="font-semibold text-lg">Productos</span>
                    </a>

                    <a
                        @click="closeMenu"
                        href="#soluciones"
                        class="flex items-center gap-4 px-4 py-4 text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-green-900/20 rounded-lg transition-colors mb-2 group"
                    >
                        <span class="material-icons-outlined text-green-700 dark:text-green-400 group-hover:scale-110 transition-transform">agriculture</span>
                        <span class="font-semibold text-lg">Soluciones Agrícolas</span>
                    </a>

                    <a
                        @click="closeMenu"
                        href="#nosotros"
                        class="flex items-center gap-4 px-4 py-4 text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-green-900/20 rounded-lg transition-colors mb-2 group"
                    >
                        <span class="material-icons-outlined text-green-700 dark:text-green-400 group-hover:scale-110 transition-transform">info</span>
                        <span class="font-semibold text-lg">Nosotros</span>
                    </a>

                    <!-- Botón de contacto destacado -->
                    <a
                        @click="closeMenu"
                        href="#contacto"
                        class="flex items-center justify-center gap-3 px-6 py-4 mt-6 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-bold rounded-xl shadow-lg transition-all transform hover:scale-105 active:scale-95"
                    >
                        <span class="material-icons-outlined">mail</span>
                        <span class="text-lg">Contacto</span>
                    </a>
                </nav>

                <!-- Footer del menú móvil -->
                <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <p class="text-xs text-center text-gray-500 dark:text-gray-400">
                        © 2026 GOLDFERT Fertilizantes
                    </p>
                </div>
            </div>
        </Transition>

        <!-- Hero Section with Slider -->
        <div id="inicio" class="relative bg-gray-900 overflow-hidden" @mouseenter="pauseAutoplay" @mouseleave="resumeAutoplay">
            <!-- Slider Container -->
            <div class="absolute inset-0">
                <!-- Slides -->
                <TransitionGroup name="hero-slide">
                    <div
                        v-for="(slide, index) in heroSlides"
                        v-show="currentSlide === index"
                        :key="index"
                        class="absolute inset-0"
                    >
                        <img
                            :alt="slide.alt"
                            class="w-full h-full object-cover object-center md:object-center"
                            :src="slide.image"
                        />
                        <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 via-green-900/70 to-transparent dark:from-black/90 dark:via-black/70 mix-blend-multiply"></div>
                    </div>
                </TransitionGroup>
            </div>

            <!-- Content (permanece estático sobre las imágenes) -->
            <div class="relative max-w-7xl mx-auto py-7 px-4 sm:py-12 md:py-16 sm:px-6 lg:px-8 min-h-[550px] sm:min-h-[600px] md:h-[650px] lg:h-[700px] flex flex-col justify-center">
                <!-- Logo GOLDfert -->
                <div
                    data-aos="fade-down"
                    data-aos-duration="1000"
                    class="mb-4 sm:mb-6"
                >
                    <img
                        src="/images/logo.png"
                        alt="GOLDfert Fertilizantes"
                        class="h-36 sm:h-44 md:h-52 lg:h-60 w-auto object-contain brightness-110 contrast-110 drop-shadow-[0_0_25px_rgba(251,191,36,0.4)]"
                        style="filter: drop-shadow(0 0 20px rgba(251, 191, 36, 0.3)) drop-shadow(0 10px 30px rgba(0, 0, 0, 0.5));"
                    />
                </div>

                <h1
                    data-aos="fade-right"
                    data-aos-duration="1000"
                    data-aos-delay="100"
                    class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-extrabold tracking-tight text-white font-display mb-2 sm:mb-3 shadow-black drop-shadow-lg"
                >
                    Nutriendo el Campo, <br/>
                    <span class="text-amber-500">Impulsando tu Cosecha</span>
                </h1>

                <p
                    data-aos="fade-right"
                    data-aos-duration="1000"
                    data-aos-delay="200"
                    class="mt-1.5 text-xs sm:text-sm md:text-base text-gray-100 max-w-xl font-light leading-relaxed"
                >
                    Soluciones nutricionales de última generación con formulaciones científicas que optimizan la absorción y asimilación de nutrientes, garantizando cultivos más productivos y rentables.
                </p>

                <div class="mt-5 sm:mt-6 md:mt-8 mb-20 sm:mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    <a class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-5 sm:py-2.5 sm:px-6 md:py-3 md:px-8 rounded-md shadow-lg transition transform hover:-translate-y-1 text-xs sm:text-sm md:text-base" href="/productos" @click.prevent="$emit('show-products')">
                        Ver Productos
                    </a>
                </div>
            </div>

            <!-- Navigation Controls -->
            <div class="absolute bottom-8 sm:bottom-10 md:bottom-12 left-0 right-0 z-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-center gap-4 sm:gap-0 sm:justify-between">
                        <!-- Previous Button - Oculto en móvil, visible en tablet+ -->
                        <button
                            @click="prevSlide"
                            class="hidden sm:flex group bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white p-2 md:p-3 rounded-full transition-all duration-300 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-transparent"
                            aria-label="Anterior"
                        >
                            <span class="material-icons-outlined text-xl md:text-2xl transform group-hover:-translate-x-1 transition-transform">chevron_left</span>
                        </button>

                        <!-- Indicators - Centrados en móvil -->
                        <div class="flex items-center gap-2 sm:gap-3">
                            <button
                                v-for="(slide, index) in heroSlides"
                                :key="index"
                                @click="goToSlide(index)"
                                :class="[
                                    'transition-all duration-300 rounded-full focus:outline-none focus:ring-2 focus:ring-amber-500',
                                    currentSlide === index
                                        ? 'w-10 sm:w-12 h-2.5 sm:h-3 bg-amber-500 shadow-lg shadow-amber-500/50'
                                        : 'w-2.5 sm:w-3 h-2.5 sm:h-3 bg-white/40 hover:bg-white/60 hover:scale-125'
                                ]"
                                :aria-label="`Ir a imagen ${index + 1}`"
                            ></button>
                        </div>

                        <!-- Next Button - Oculto en móvil, visible en tablet+ -->
                        <button
                            @click="nextSlide"
                            class="hidden sm:flex group bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white p-2 md:p-3 rounded-full transition-all duration-300 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-transparent"
                            aria-label="Siguiente"
                        >
                            <span class="material-icons-outlined text-xl md:text-2xl transform group-hover:translate-x-1 transition-transform">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Wave -->
            <div class="wave-container">
                <svg class="relative block w-[calc(100%+1.3px)] h-[60px]" data-name="Layer 1" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-gray-50 dark:fill-gray-900" d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
                </svg>
            </div>
        </div>

        <!-- What We Do Section -->
        <section id="soluciones" class="py-16 bg-gray-50 dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-left mb-12 flex items-center" data-aos="fade-right">
                    <h2 class="text-3xl font-extrabold text-green-900 dark:text-white font-display">¿Qué Hacemos?</h2>
                    <div class="flex-grow h-px bg-gray-300 dark:bg-gray-700 ml-6"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        data-aos="fade-up"
                        data-aos-duration="600"
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-8 text-center border-t-4 border-green-700 dark:border-green-500 hover:shadow-xl transition duration-300"
                    >
                        <div class="w-16 h-16 bg-green-700 dark:bg-green-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white shadow-lg">
                            <span class="material-icons-outlined text-3xl">spa</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 font-display">Fertilizantes Foliares</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                            Formulación y desarrollo de fertilizantes foliares efectivos para una rápida absorción de nutrientes.
                        </p>
                    </div>

                    <div
                        data-aos="fade-up"
                        data-aos-duration="600"
                        data-aos-delay="100"
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-8 text-center border-t-4 border-green-700 dark:border-green-500 hover:shadow-xl transition duration-300 transform md:-translate-y-4"
                    >
                        <div class="w-16 h-16 bg-green-700 dark:bg-green-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white shadow-lg">
                            <span class="material-icons-outlined text-3xl">science</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 font-display">Nutrición Especializada</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                            Soluciones adaptadas a cada cultivo y etapa de crecimiento para maximizar el potencial genético.
                        </p>
                    </div>

                    <div
                        data-aos="fade-up"
                        data-aos-duration="600"
                        data-aos-delay="200"
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-8 text-center border-t-4 border-green-700 dark:border-green-500 hover:shadow-xl transition duration-300"
                    >
                        <div class="w-16 h-16 bg-green-700 dark:bg-green-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white shadow-lg">
                            <span class="material-icons-outlined text-3xl">local_florist</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 font-display">Bioestimulantes Agrícolas</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                            Tecnología avanzada para potenciar el crecimiento y combatir el estrés abiótico en las plantas.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefits Section -->
        <section class="py-12 bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10" data-aos="fade-up">
                    <h2 class="text-2xl font-bold text-green-900 dark:text-green-400 font-display">Beneficios para tu Cultivo</h2>
                    <div class="w-24 h-1 bg-amber-500 mx-auto mt-4 rounded"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="flex flex-col items-center text-center p-4" data-aos="zoom-in" data-aos-delay="0">
                        <div class="p-3 bg-amber-100 dark:bg-amber-900/30 rounded-full mb-3 text-amber-500">
                            <span class="material-icons-outlined text-3xl">trending_up</span>
                        </div>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-2">Mayor Rendimiento</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Aumenta la productividad de tus cosechas significativamente.</p>
                    </div>

                    <div class="flex flex-col items-center text-center p-4" data-aos="zoom-in" data-aos-delay="100">
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-full mb-3 text-green-700 dark:text-green-400">
                            <span class="material-icons-outlined text-3xl">water_drop</span>
                        </div>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-2">Mejor Absorción</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Nutrientes de rápida asimilación y transporte sistémico.</p>
                    </div>

                    <div class="flex flex-col items-center text-center p-4" data-aos="zoom-in" data-aos-delay="200">
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-full mb-3 text-green-700 dark:text-green-400">
                            <span class="material-icons-outlined text-3xl">shield</span>
                        </div>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-2">Más Resistencia</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Fortalece tus plantas contra el estrés climático y plagas.</p>
                    </div>

                    <div class="flex flex-col items-center text-center p-4" data-aos="zoom-in" data-aos-delay="300">
                        <div class="p-3 bg-amber-100 dark:bg-amber-900/30 rounded-full mb-3 text-amber-500">
                            <span class="material-icons-outlined text-3xl">emoji_nature</span>
                        </div>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-2">Nutrición Completa</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Equilibrio ideal de macro y micronutrientes esenciales.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section id="productos" class="py-20 relative bg-green-900 dark:bg-black">
            <div class="wave-top">
                <svg class="relative block w-[calc(100%+1.3px)] h-[50px]" data-name="Layer 1" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-gray-50 dark:fill-gray-900" d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
                </svg>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white font-display inline-block border-b-2 border-amber-500 pb-2">Nuestros Productos GOLDFERT</h2>
                    <p class="text-green-100 mt-4 text-base sm:text-lg max-w-3xl mx-auto">Soluciones especializadas para cada etapa de tu cultivo</p>
                </div>

                <!-- Imagen Hero de Productos -->
                <div class="mb-16" data-aos="zoom-in" data-aos-duration="1200">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-green-700/30 dark:border-green-500/30 hover:border-amber-500/50 dark:hover:border-amber-500/50 transition-all duration-300 transform hover:scale-[1.02]">
                        <img
                            src="/images/portada1.2.png"
                            alt="Productos GOLDfert: SULFERT, CALBORZINC y VITAL Mix en campo de cultivo"
                            class="w-full h-auto object-cover"
                        />
                        <!-- Gradiente con colores de la marca (verde y ámbar) -->
                        <div class="absolute inset-0 bg-gradient-to-t from-green-900/80 via-green-700/40 to-transparent dark:from-black/70 dark:via-green-900/30"></div>
                        <!-- Overlay adicional con ámbar para destacar -->
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 via-transparent to-green-600/20"></div>
                        <!-- Contenido del texto -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8">
                            <div class="bg-white/10 dark:bg-black/20 backdrop-blur-sm rounded-xl p-4 sm:p-6 border border-white/20 dark:border-white/10">
                                <p class="text-white text-lg sm:text-xl md:text-2xl font-bold text-center drop-shadow-2xl font-display">
                                    <span class="text-amber-400">Fertilizantes</span> de Alta Tecnología para
                                    <span class="text-green-300">Máximos Rendimientos</span>
                                </p>
                                <!-- Línea decorativa -->
                                <div class="w-24 h-1 bg-amber-500 mx-auto mt-4 rounded-full shadow-lg shadow-amber-500/50"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cards de Productos -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <!-- SULFERT -->
                    <div
                        data-aos="flip-left"
                        data-aos-duration="800"
                        class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-2xl transform transition hover:scale-105 hover:shadow-amber-500/20"
                    >
                        <div class="h-56 bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-900/20 dark:to-amber-900/20 flex items-center justify-center p-6 relative">
                            <div class="absolute top-4 right-4">
                                <span class="bg-amber-500 text-white text-xs font-bold px-3 py-1 rounded-full">Premium</span>
                        </div>
                            <div class="text-center">
                                <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-orange-400 to-amber-500 rounded-2xl flex items-center justify-center shadow-xl">
                                    <span class="material-icons-outlined text-white text-5xl">spa</span>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="text-2xl font-bold text-orange-900 dark:text-orange-400 font-display">SULFERT</h3>
                                    <p class="text-sm text-orange-700 dark:text-orange-300 font-semibold">Fertilizante Foliar</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 leading-relaxed">
                                Fertilizante foliar especializado con azufre para mejorar la calidad y vigor de tus cultivos. Fórmula concentrada de rápida absorción.
                            </p>
                            <button
                                @click="$emit('show-products')"
                                class="bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-bold py-3 px-6 rounded-lg w-full transition-all transform hover:scale-105 shadow-lg hover:shadow-xl"
                            >
                                Ver Detalles
                            </button>
                        </div>
                    </div>

                    <!-- CALBORZINC -->
                    <div
                        data-aos="flip-left"
                        data-aos-duration="800"
                        data-aos-delay="100"
                        class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-2xl transform transition hover:scale-105 hover:shadow-cyan-500/20 lg:scale-105"
                    >
                        <div class="h-56 bg-gradient-to-br from-cyan-50 to-blue-50 dark:from-cyan-900/20 dark:to-blue-900/20 flex items-center justify-center p-6 relative">
                            <div class="absolute top-4 right-4">
                                <span class="bg-cyan-500 text-white text-xs font-bold px-3 py-1 rounded-full">Destacado</span>
                        </div>
                            <div class="text-center">
                                <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-2xl flex items-center justify-center shadow-xl">
                                    <span class="material-icons-outlined text-white text-5xl">agriculture</span>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="text-2xl font-bold text-cyan-900 dark:text-cyan-400 font-display">CALBORZINC</h3>
                                    <p class="text-sm text-cyan-700 dark:text-cyan-300 font-semibold">Fertilizante Foliar</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 leading-relaxed">
                                Complejo nutritivo con Calcio, Boro y Zinc. Ideal para fortalecer estructura celular, mejorar floración y cuajado de frutos.
                            </p>
                            <button
                                @click="$emit('show-products')"
                                class="bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white font-bold py-3 px-6 rounded-lg w-full transition-all transform hover:scale-105 shadow-lg hover:shadow-xl"
                            >
                                Ver Detalles
                            </button>
                        </div>
                    </div>

                    <!-- VITAL Mix -->
                    <div
                        data-aos="flip-left"
                        data-aos-duration="800"
                        data-aos-delay="200"
                        class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-2xl transform transition hover:scale-105 hover:shadow-green-500/20"
                    >
                        <div class="h-56 bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 flex items-center justify-center p-6 relative">
                            <div class="absolute top-4 right-4">
                                <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">Bioestimulante</span>
                        </div>
                            <div class="text-center">
                                <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl flex items-center justify-center shadow-xl">
                                    <span class="material-icons-outlined text-white text-5xl">eco</span>
                        </div>
                                <div class="space-y-1">
                                    <h3 class="text-2xl font-bold text-green-900 dark:text-green-400 font-display">VITAL Mix</h3>
                                    <p class="text-sm text-green-700 dark:text-green-300 font-semibold">Bioestimulante</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 leading-relaxed">
                                Bioestimulante de composición química concentrada. Activa procesos fisiológicos vitales y mejora la resistencia al estrés.
                            </p>
                            <button
                                @click="$emit('show-products')"
                                class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-bold py-3 px-6 rounded-lg w-full transition-all transform hover:scale-105 shadow-lg hover:shadow-xl"
                            >
                                Ver Detalles
                            </button>
                    </div>
                    </div>
                </div>

                <!-- Botón Ver Catálogo Completo -->
                <div class="mt-16 text-center" data-aos="fade-up" data-aos-delay="400">
                    <button
                        @click="$emit('show-products')"
                        class="inline-flex items-center gap-3 bg-white hover:bg-amber-50 text-green-900 font-bold py-4 px-8 rounded-xl shadow-2xl transition-all transform hover:scale-105 hover:-translate-y-1 border-2 border-amber-500"
                    >
                        <span class="material-icons-outlined text-2xl">inventory_2</span>
                        <span class="text-lg">Ver Catálogo Completo</span>
                        <span class="material-icons-outlined text-2xl">arrow_forward</span>
                    </button>
                </div>
            </div>

            <div class="wave-bottom">
                <svg class="relative block w-[calc(100%+1.3px)] h-[50px]" data-name="Layer 1" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-gray-50 dark:fill-gray-900" d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"></path>
                </svg>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section id="nosotros" class="py-16 bg-gray-50 dark:bg-gray-900 overflow-hidden">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-3xl font-extrabold text-green-900 dark:text-white font-display">Por Qué Elegirnos</h2>
                    <div class="w-16 h-1 bg-amber-500 mx-auto mt-2"></div>
                </div>

                <div class="relative">
                    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                        <img alt="Farm texture" class="w-full h-full object-cover rounded-3xl" src="/images/horizonte.png"/>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
                        <div class="relative" data-aos="fade-right" data-aos-duration="1000">
                            <div class="absolute inset-0 bg-amber-500/20 rounded-3xl transform -rotate-3 z-0"></div>
                            <img alt="Smiling agronomist with hat" class="relative z-10 rounded-3xl shadow-2xl border-4 border-white dark:border-gray-700" src="/images/footer.png"/>
                        </div>

                        <div class="space-y-10">
                            <div class="flex" data-aos="fade-left" data-aos-delay="100">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-14 w-14 rounded-full bg-green-900 dark:bg-green-800 text-white border-2 border-amber-500">
                                        <span class="material-icons-outlined">verified</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg leading-6 font-bold text-gray-900 dark:text-white font-display">Experiencia y Calidad</h3>
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                        Más de 20 años formulando soluciones que cumplen con los estándares internacionales más exigentes.
                                    </p>
                                </div>
                            </div>

                            <div class="flex" data-aos="fade-left" data-aos-delay="200">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-14 w-14 rounded-full bg-green-900 dark:bg-green-800 text-white border-2 border-amber-500">
                                        <span class="material-icons-outlined">support_agent</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg leading-6 font-bold text-gray-900 dark:text-white font-display">Asesoría Profesional</h3>
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                        Acompañamiento técnico constante por ingenieros agrónomos expertos en nutrición vegetal.
                                    </p>
                                </div>
                            </div>

                            <div class="flex" data-aos="fade-left" data-aos-delay="300">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-14 w-14 rounded-full bg-green-900 dark:bg-green-800 text-white border-2 border-amber-500">
                                        <span class="material-icons-outlined">lightbulb</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg leading-6 font-bold text-gray-900 dark:text-white font-display">Innovación Constante</h3>
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                        Investigación continua para desarrollar moléculas que maximicen la eficiencia de cada gota.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TikTok Videos Section -->
        <section class="py-16 sm:py-20 bg-green-900 dark:bg-gray-900 relative">
            <!-- Wave Superior -->
            <div class="wave-top">
                <svg class="relative block w-[calc(100%+1.3px)] h-[50px]" data-name="Layer 1" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-gray-50 dark:fill-gray-900" d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
                </svg>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <!-- Header -->
                <div class="text-center mb-12" data-aos="fade-up">
                    <div class="inline-flex items-center gap-3 bg-amber-500/20 backdrop-blur-sm px-5 py-2.5 rounded-full mb-5 border border-amber-500/30">
                        <svg class="w-6 h-6 text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                        </svg>
                        <span class="text-amber-500 font-bold text-sm uppercase tracking-wide">Síguenos en TikTok</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white font-display inline-block border-b-2 border-amber-500 pb-2 mb-4">Mira Nuestros Videos</h2>
                    <p class="text-green-100 text-base sm:text-lg max-w-2xl mx-auto mt-4">Aprende sobre nuestros productos y descubre resultados reales en el campo</p>
                </div>

                <!-- Slider Container -->
                <div class="relative" data-aos="zoom-in" data-aos-duration="1000">
                    <!-- Video Principal -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-2xl border-4 border-amber-500/30">
                        <div class="bg-black relative min-h-[500px] sm:min-h-[600px] flex items-center justify-center">
                            <!-- Video Embed usando blockquote (formato oficial de TikTok) -->
                            <div class="w-full h-full flex items-center justify-center p-4 relative min-h-[500px] sm:min-h-[600px]">
                                <template v-for="(video, index) in tiktokVideos" :key="`video-${video.id}`">
                                    <blockquote
                                        v-show="currentTikTokVideo === index"
                                        class="tiktok-embed"
                                        :cite="video.url"
                                        :data-video-id="video.videoId"
                                        :data-rendered="false"
                                        style="max-width: 100%; min-width: 325px;"
                                    >
                                        <section>
                                            <a
                                                :href="video.url"
                                                target="_blank"
                                                :title="video.title"
                                            >{{ video.title }}</a>
                                        </section>
                                    </blockquote>
                                </template>
                                <!-- Loading State -->
                                <div v-if="!tiktokScriptLoaded" class="absolute inset-0 flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-white mb-4"></div>
                                        <p class="text-lg font-semibold">Cargando videos...</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Controles sobre el video (solo visible en hover en desktop) -->
                            <div class="absolute inset-0 bg-black/0 hover:bg-black/20 transition-colors duration-300 flex items-center justify-between px-4 opacity-0 hover:opacity-100 pointer-events-none hover:pointer-events-auto">
                                <button
                                    @click="prevTikTokVideo"
                                    class="bg-white/90 hover:bg-white text-gray-900 p-3 rounded-full shadow-xl transition-all transform hover:scale-110 hidden sm:flex items-center justify-center pointer-events-auto"
                                    aria-label="Video anterior"
                                >
                                    <span class="material-icons-outlined">chevron_left</span>
                                </button>
                                <button
                                    @click="nextTikTokVideo"
                                    class="bg-white/90 hover:bg-white text-gray-900 p-3 rounded-full shadow-xl transition-all transform hover:scale-110 hidden sm:flex items-center justify-center pointer-events-auto"
                                    aria-label="Siguiente video"
                                >
                                    <span class="material-icons-outlined">chevron_right</span>
                                </button>
                            </div>
                        </div>

                        <!-- Info del Video y Controles Móviles -->
                        <div class="p-4 sm:p-6 bg-gradient-to-r from-green-50 to-amber-50 dark:from-green-900/20 dark:to-amber-900/20">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">{{ tiktokVideos[currentTikTokVideo].title }}</h3>
                                <a
                                    :href="tiktokVideos[currentTikTokVideo].url"
                                    target="_blank"
                                    class="inline-flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-3 py-2 rounded-lg transition-all transform hover:scale-105 text-sm font-semibold"
                                >
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                    </svg>
                                    Ver en TikTok
                                </a>
                            </div>

                            <!-- Controles Móviles -->
                            <div class="flex sm:hidden items-center justify-between gap-4">
                                <button
                                    @click="prevTikTokVideo"
                                    class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg font-semibold transition-colors flex items-center justify-center gap-2"
                                >
                                    <span class="material-icons-outlined">chevron_left</span>
                                    Anterior
                                </button>
                                <button
                                    @click="nextTikTokVideo"
                                    class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg font-semibold transition-colors flex items-center justify-center gap-2"
                                >
                                    Siguiente
                                    <span class="material-icons-outlined">chevron_right</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Galería de Videos (Thumbnails) -->
                    <div class="mt-6 sm:mt-8">
                        <div class="flex items-center justify-center gap-2 sm:gap-3 flex-wrap max-w-4xl mx-auto">
                            <button
                                v-for="(video, index) in tiktokVideos"
                                :key="video.id"
                                @click="selectTikTokVideo(index)"
                                :class="[
                                    'group relative overflow-hidden rounded-lg transition-all duration-300 transform cursor-pointer',
                                    currentTikTokVideo === index
                                        ? 'ring-4 ring-amber-500 scale-110 shadow-2xl shadow-amber-500/50 z-10'
                                        : 'ring-2 ring-white/30 hover:ring-white/60 hover:scale-105 opacity-70 hover:opacity-100'
                                ]"
                                :aria-label="`Ver video: ${video.title}`"
                            >
                                <!-- Thumbnail Container -->
                                <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-green-600 via-amber-500 to-green-600 flex items-center justify-center relative">
                                    <!-- Número del video -->
                                    <div class="absolute top-1 left-1 bg-black/60 text-white text-xs font-bold w-6 h-6 rounded-full flex items-center justify-center">
                                        {{ index + 1 }}
                                    </div>
                                    <!-- Icono TikTok -->
                                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                    </svg>
                                    <!-- Play Icon Overlay -->
                                    <div
                                        v-if="currentTikTokVideo !== index"
                                        class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                    >
                                        <span class="material-icons-outlined text-white text-2xl sm:text-3xl">play_circle</span>
                                    </div>
                                    <!-- Indicador activo -->
                                    <div
                                        v-if="currentTikTokVideo === index"
                                        class="absolute inset-0 bg-amber-500/20 flex items-center justify-center"
                                    >
                                        <div class="w-3 h-3 bg-amber-500 rounded-full animate-pulse"></div>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <!-- Contador de videos -->
                        <div class="text-center mt-4">
                            <p class="text-green-100 text-sm">
                                Video {{ currentTikTokVideo + 1 }} de {{ tiktokVideos.length }}
                            </p>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="mt-8 text-center" data-aos="fade-up" data-aos-delay="200">
                        <a
                            :href="socialMedia.tiktok"
                            target="_blank"
                            class="inline-flex items-center gap-3 bg-white hover:bg-gray-50 text-gray-900 font-bold py-4 px-8 rounded-xl shadow-2xl transition-all transform hover:scale-105 border-2 border-gray-900"
                        >
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                            </svg>
                            <span>Síguenos en @goldfert</span>
                            <span class="material-icons-outlined">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contacto" class="py-16 bg-white dark:bg-gray-900 relative">
            <div class="absolute top-0 left-0 w-full h-12 bg-gradient-to-b from-gray-100 dark:from-gray-800 to-transparent pointer-events-none"></div>

            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10" data-aos="fade-up">
                    <h2 class="text-3xl font-extrabold text-green-900 dark:text-white font-display">Contáctanos</h2>
                    <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                        ¿Listo para impulsar tu cosecha? <span class="font-bold text-green-700 dark:text-green-400">¡Hablemos!</span>
                    </p>
                </div>

                <form
                    @submit.prevent="handleSubmit"
                    data-aos="fade-up"
                    data-aos-delay="100"
                    class="bg-gray-50 dark:bg-gray-800 shadow-xl rounded-2xl p-8 sm:p-12 border border-gray-100 dark:border-gray-700"
                >
                    <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="name">Nombre Completo</label>
                            <div class="mt-1">
                                <input v-model="form.name" class="py-3 px-4 block w-full shadow-sm focus:ring-amber-500 focus:border-amber-500 border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md" id="name" name="name" placeholder="Juan Pérez" type="text"/>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="email">Correo Electrónico</label>
                            <div class="mt-1">
                                <input v-model="form.email" class="py-3 px-4 block w-full shadow-sm focus:ring-amber-500 focus:border-amber-500 border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md" id="email" name="email" placeholder="correo@ejemplo.com" type="email"/>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="phone">Teléfono</label>
                            <div class="mt-1">
                                <input v-model="form.phone" class="py-3 px-4 block w-full shadow-sm focus:ring-amber-500 focus:border-amber-500 border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md" id="phone" name="phone" placeholder="+54 11 ..." type="text"/>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="message">Mensaje</label>
                            <div class="mt-1">
                                <textarea v-model="form.message" class="py-3 px-4 block w-full shadow-sm focus:ring-amber-500 focus:border-amber-500 border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-md" id="message" name="message" placeholder="¿En qué podemos ayudarte?" rows="4"></textarea>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <button
                                :disabled="submitting"
                                class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-bold text-white bg-green-700 dark:bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                type="submit"
                            >
                                <span v-if="submitting" class="inline-block animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-2"></span>
                                <span v-else class="material-icons-outlined mr-2">send</span>
                                {{ submitting ? 'Enviando...' : 'Enviar Mensaje' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-green-900 dark:bg-black text-white">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Logo y descripción -->
                    <div>
                        <div class="flex items-center mb-4">
                            <img src="/images/logo.png"
                                 alt="GOLDfert Fertilizantes"
                                 class="h-12 w-auto object-contain">
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed mb-4">
                            Comprometidos con el desarrollo agrícola sostenible a través de la innovación y la calidad.
                        </p>
                        <!-- Redes Sociales -->
                        <div class="flex gap-3 mt-4">
                            <a :href="socialMedia.facebook" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-amber-500 hover:bg-amber-600 rounded-full flex items-center justify-center transition-all transform hover:scale-110" aria-label="Facebook">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a :href="socialMedia.instagram" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-amber-500 hover:bg-amber-600 rounded-full flex items-center justify-center transition-all transform hover:scale-110" aria-label="Instagram">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            <a :href="'https://wa.me/' + contactInfo.whatsapp.replace(/\D/g,'')" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-green-500 hover:bg-green-600 rounded-full flex items-center justify-center transition-all transform hover:scale-110" aria-label="WhatsApp">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                            </a>
                            <a :href="socialMedia.tiktok" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-black hover:bg-gray-800 rounded-full flex items-center justify-center transition-all transform hover:scale-110" aria-label="TikTok">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Información de Contacto -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-200 tracking-wider uppercase mb-4">Contacto</h3>
                        <ul class="space-y-3">
                            <!-- Teléfono 1 con WhatsApp -->
                            <li class="flex items-start gap-3">
                                <span class="material-icons-outlined text-amber-500 text-xl">phone</span>
                                <div class="flex-1">
                                    <p class="text-gray-400 text-sm mb-1">Teléfono 1</p>
                                    <div class="flex items-center gap-3">
                                        <a :href="'tel:' + contactInfo.phone.replace(/\D/g,'')" class="text-white hover:text-amber-500 transition">{{ contactInfo.phone }}</a>
                                        <a :href="contactInfo.whatsapp1Link" target="_blank" class="inline-flex items-center gap-1 bg-green-500 hover:bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded transition">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                            </svg>
                                            WhatsApp
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <!-- Teléfono 2 con WhatsApp -->
                            <li class="flex items-start gap-3">
                                <span class="material-icons-outlined text-amber-500 text-xl">phone</span>
                                <div class="flex-1">
                                    <p class="text-gray-400 text-sm mb-1">Teléfono 2</p>
                                    <div class="flex items-center gap-3">
                                        <a :href="'tel:' + contactInfo.phone2.replace(/\D/g,'')" class="text-white hover:text-amber-500 transition">{{ contactInfo.phone2 }}</a>
                                        <a :href="contactInfo.whatsapp2Link" target="_blank" class="inline-flex items-center gap-1 bg-green-500 hover:bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded transition">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                            </svg>
                                            WhatsApp
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-icons-outlined text-amber-500 text-xl">email</span>
                                <div>
                                    <p class="text-gray-400 text-sm">Email</p>
                                    <a :href="'mailto:' + contactInfo.email" class="text-white hover:text-amber-500 transition">{{ contactInfo.email }}</a>
                                </div>
                            </li>
                            <!-- <li class="flex items-start gap-3">
                                <span class="material-icons-outlined text-amber-500 text-xl">location_on</span>
                                <div>
                                    <p class="text-gray-400 text-sm">Dirección</p>
                                    <p class="text-white text-sm">{{ contactInfo.address }}</p>
                                </div>
                            </li> -->
                        </ul>
                    </div>

                    <!-- Horarios de Atención -->
                    <!-- <div>
                        <h3 class="text-sm font-semibold text-gray-200 tracking-wider uppercase mb-4">Horarios</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="material-icons-outlined text-amber-500 text-xl">schedule</span>
                    <div>
                                    <p class="text-white text-sm font-medium">{{ schedule.weekdays }}</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-icons-outlined text-amber-500 text-xl">schedule</span>
                                <div>
                                    <p class="text-white text-sm font-medium">{{ schedule.saturday }}</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-icons-outlined text-amber-500 text-xl">schedule</span>
                                <div>
                                    <p class="text-gray-400 text-sm">{{ schedule.sunday }}</p>
                                </div>
                            </li>
                        </ul>
                    </div> -->

                    <!-- Enlaces Rápidos -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-200 tracking-wider uppercase mb-4">Enlaces Rápidos</h3>
                        <ul class="space-y-2">
                            <li><a class="text-gray-400 hover:text-white transition flex items-center gap-2" href="#inicio">
                                <span class="material-icons-outlined text-sm">arrow_forward</span>
                                Inicio
                            </a></li>
                            <li><a class="text-gray-400 hover:text-white transition flex items-center gap-2" href="/productos" @click.prevent="$emit('show-products')">
                                <span class="material-icons-outlined text-sm">arrow_forward</span>
                                Productos
                            </a></li>
                            <li><a class="text-gray-400 hover:text-white transition flex items-center gap-2" href="#soluciones">
                                <span class="material-icons-outlined text-sm">arrow_forward</span>
                                Soluciones
                            </a></li>
                            <li><a class="text-gray-400 hover:text-white transition flex items-center gap-2" href="#nosotros">
                                <span class="material-icons-outlined text-sm">arrow_forward</span>
                                Nosotros
                            </a></li>
                            <li><a class="text-gray-400 hover:text-white transition flex items-center gap-2" href="#contacto">
                                <span class="material-icons-outlined text-sm">arrow_forward</span>
                                Contacto
                            </a></li>
                        </ul>
                    </div>
                </div>

                <!-- Copyright y Legal -->
                <div class="mt-12 pt-8 border-t border-gray-800">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <p class="text-sm text-gray-400 text-center md:text-left">
                            © 2026 GOLDFERT Fertilizantes. Todos los derechos reservados.
                        </p>
                        <div class="flex gap-6">
                            <a href="#" class="text-sm text-gray-400 hover:text-white transition">Privacidad</a>
                            <a href="#" class="text-sm text-gray-400 hover:text-white transition">Términos</a>
                            <a href="#" class="text-sm text-gray-400 hover:text-white transition">Cookies</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <ToastContainer />
    </div>
</template>

<script>
import axios from 'axios';
import { useToast } from '../composables/useToast';
import ToastContainer from './ToastContainer.vue';
import { tiktokVideos, loadTikTokEmbedScript } from '../helper/helper.js';

export default {
    name: 'Home',
    components: {
        ToastContainer
    },
    data() {
        return {
            mobileMenuOpen: false,
            submitting: false,
            toast: null,
            // Hero Slider
            currentSlide: 0,
            autoplayInterval: null,
            isAutoplayPaused: false,
            heroSlides: [
                {
                    image: '/images/portada1.1.png',
                    alt: 'Productos GOLDfert en campo de cultivo'
                },
                {
                    image: '/images/portada1.2.png',
                    alt: 'Fertilizantes foliares especializados'
                },
                {
                    image: '/images/portada1.3.png',
                    alt: 'Soluciones agrícolas de alta eficiencia'
                }
            ],
            form: {
                name: '',
                email: '',
                phone: '',
                message: ''
            },
            contactInfo: {
                phone: '71616724',
                phone2: '78000965',
                email: 'goldfertfertilixantes@gmail.com',
                address: '',
                whatsapp: '+59171616724',
                whatsapp1Link: 'https://wa.me/59171616724',
                whatsapp2Link: 'https://wa.me/59178000965'
            },
            socialMedia: {
                facebook: 'https://www.facebook.com/profile.php?id=100054637500718',
                instagram: 'https://www.instagram.com/goldfert.rg?igsh=NGtiNGE3eGxybDNn&utm_source=qr',
                tiktok: 'https://www.tiktok.com/@goldfert?_r=1&_t=ZM-92zYeasqdTg',
                twitter: '#',
                linkedin: '#'
            },
            // Slider de Videos TikTok
            currentTikTokVideo: 0,
            tiktokVideos: tiktokVideos,
            tiktokScriptLoaded: false,
            schedule: {
                weekdays: 'Lunes - Viernes: 8:00 AM - 6:00 PM',
                saturday: 'Sábado: 9:00 AM - 2:00 PM',
                sunday: 'Domingo: Cerrado'
            }
        }
    },
    mounted() {
        // Inicializar toast
        this.toast = useToast();

        // Inicializar AOS
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                once: true,
                offset: 100,
                easing: 'ease-in-out'
            });
        }

        // Prevenir scroll automático al hash en móvil
        this.preventAutoScroll();

        // Iniciar autoplay del slider hero
        this.startAutoplay();

        // Cargar script de TikTok para los embeds
        this.loadTikTokScript();

        // Smooth scroll para navegación
        this.setupSmoothScroll();
    },
    beforeUnmount() {
        // Limpiar el intervalo del slider al destruir el componente
        this.stopAutoplay();
    },
    methods: {
        closeMenu() {
            this.mobileMenuOpen = false;
        },
        // Hero Slider Methods
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.heroSlides.length;
        },
        prevSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.heroSlides.length) % this.heroSlides.length;
        },
        goToSlide(index) {
            this.currentSlide = index;
        },
        startAutoplay() {
            this.autoplayInterval = setInterval(() => {
                if (!this.isAutoplayPaused) {
                    this.nextSlide();
                }
            }, 5000); // Cambiar cada 5 segundos
        },
        stopAutoplay() {
            if (this.autoplayInterval) {
                clearInterval(this.autoplayInterval);
                this.autoplayInterval = null;
            }
        },
        pauseAutoplay() {
            this.isAutoplayPaused = true;
        },
        resumeAutoplay() {
            this.isAutoplayPaused = false;
        },
        // TikTok Slider Methods
        nextTikTokVideo() {
            this.currentTikTokVideo = (this.currentTikTokVideo + 1) % this.tiktokVideos.length;
            this.renderTikTokVideo();
        },
        prevTikTokVideo() {
            this.currentTikTokVideo = (this.currentTikTokVideo - 1 + this.tiktokVideos.length) % this.tiktokVideos.length;
            this.renderTikTokVideo();
        },
        selectTikTokVideo(index) {
            this.currentTikTokVideo = index;
            this.renderTikTokVideo();
        },
        async loadTikTokScript() {
            try {
                await loadTikTokEmbedScript();
                this.tiktokScriptLoaded = true;
                // Esperar un poco más para que TikTok inicialice completamente
                setTimeout(() => {
                    this.renderTikTokVideo();
                }, 1000);
            } catch (error) {
                console.error('Error al cargar script de TikTok:', error);
                // Intentar usar el script que ya está en el head
                if (document.querySelector('script[src*="tiktok.com/embed.js"]')) {
                    setTimeout(() => {
                        this.tiktokScriptLoaded = true;
                        this.renderTikTokVideo();
                    }, 2000);
                }
            }
        },
        renderTikTokVideo() {
            // Usar nextTick para asegurar que el DOM esté actualizado
            this.$nextTick(() => {
                if (window.tiktokEmbed && window.tiktokEmbed.lib) {
                    // Renderizar el blockquote del video actual
                    const currentVideo = this.tiktokVideos[this.currentTikTokVideo];
                    if (currentVideo && currentVideo.videoId) {
                        const blockquote = document.querySelector(`.tiktok-embed[data-video-id="${currentVideo.videoId}"]`);
                        if (blockquote) {
                            const isRendered = blockquote.getAttribute('data-rendered') === 'true';
                            if (!isRendered) {
                                try {
                                    window.tiktokEmbed.lib.render(blockquote);
                                    blockquote.setAttribute('data-rendered', 'true');
                                } catch (error) {
                                    console.error('Error al renderizar video de TikTok:', error);
                                    // Reintentar después de un segundo
                                    setTimeout(() => {
                                        this.renderTikTokVideo();
                                    }, 1000);
                                }
                            }
                        }
                    }
                } else {
                    // Si el script aún no está cargado, intentar de nuevo
                    setTimeout(() => {
                        this.renderTikTokVideo();
                    }, 500);
                }
            });
        },
        preventAutoScroll() {
            // Prevenir scroll automático cuando hay hash en la URL al cargar
            // En móvil, siempre empezar en el inicio a menos que el usuario haga clic explícitamente
            const hash = window.location.hash;

            // Si hay hash y no es #inicio, esperar un momento y luego hacer scroll suave
            if (hash && hash !== '#inicio') {
                this.$nextTick(() => {
                    setTimeout(() => {
                        const target = document.querySelector(hash);
                        if (target) {
                            const headerOffset = 80;
                            const elementPosition = target.getBoundingClientRect().top;
                            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                            window.scrollTo({
                                top: offsetPosition,
                                behavior: 'smooth'
                            });
                        }
                    }, 300);
                });
            } else {
                // Si no hay hash o es #inicio, asegurar que estemos en el inicio
                this.$nextTick(() => {
                    window.scrollTo({ top: 0, behavior: 'auto' });
                });
            }
        },
        setupSmoothScroll() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        const headerOffset = 80;
                        const elementPosition = target.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        },
        async handleSubmit() {
            if (!this.toast) {
                this.toast = useToast();
            }

            // Validación básica
            if (!this.form.name || !this.form.name.trim()) {
                this.toast.warning('El nombre es obligatorio.');
                return;
            }
            if (!this.form.email || !this.form.email.trim()) {
                this.toast.warning('El correo electrónico es obligatorio.');
                return;
            }
            if (!this.form.message || !this.form.message.trim()) {
                this.toast.warning('El mensaje es obligatorio.');
                return;
            }

            this.submitting = true;

            try {
                const response = await axios.post('/api/contact', this.form, {
                    withCredentials: true,
                });

                if (response.data) {
                    this.toast.success(response.data.message || 'Mensaje enviado exitosamente. Nos pondremos en contacto contigo pronto.');
            this.form = {
                name: '',
                email: '',
                phone: '',
                message: ''
            };
        }
            } catch (error) {
                console.error('Error al enviar contacto:', error);
                if (error.response && error.response.data) {
                    if (error.response.data.errors) {
                        const errors = error.response.data.errors;
                        Object.keys(errors).forEach((field) => {
                            errors[field].forEach((message) => {
                                this.toast.error(message);
                            });
                        });
                    } else if (error.response.data.message) {
                        this.toast.error(error.response.data.message);
                    } else {
                        this.toast.error('Error al enviar el mensaje. Por favor, intenta de nuevo.');
                    }
                } else {
                    this.toast.error('Error de conexión. Por favor, verifica tu conexión a internet.');
                }
            } finally {
                this.submitting = false;
            }
        }
    }
}
</script>

<style scoped>
/* Hero Slider Transitions */
.hero-slide-enter-active {
    transition: opacity 1.2s ease-in-out, transform 1.2s ease-in-out;
}

.hero-slide-leave-active {
    transition: opacity 1.2s ease-in-out, transform 1.2s ease-in-out;
}

.hero-slide-enter-from {
    opacity: 0;
    transform: scale(1.1);
}

.hero-slide-leave-to {
    opacity: 0;
    transform: scale(0.95);
}

/* TikTok Video Slider Transitions */
.video-fade-enter-active,
.video-fade-leave-active {
    transition: opacity 0.5s ease-in-out;
}

.video-fade-enter-from,
.video-fade-leave-to {
    opacity: 0;
}

/* TikTok Embed Styles */
.tiktok-embed {
    margin: 0 auto;
    width: 100%;
    max-width: 325px;
}

.tiktok-embed iframe {
    width: 100%;
    height: 100%;
    border: none;
}

/* Loading state para videos */
.tiktok-embed[data-rendered="false"] {
    min-height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.tiktok-embed[data-rendered="false"]::before {
    content: "Cargando video...";
    color: white;
    font-weight: bold;
}

.wave-container {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.wave-container svg {
    position: relative;
    display: block;
    width: calc(138% + 1.3px);
    height: 60px;
}

.wave-top {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

.wave-top svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 50px;
}

.wave-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.wave-bottom svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 50px;
}

/* Transiciones para el menú móvil */
/* Fade transition para el overlay */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Slide transition para el drawer */
.slide-enter-active,
.slide-leave-active {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.slide-enter-from {
    transform: translateX(100%);
}

.slide-leave-to {
    transform: translateX(100%);
}
</style>
