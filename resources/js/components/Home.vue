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
                        <a class="font-medium text-gray-600 dark:text-gray-300 hover:text-green-700 dark:hover:text-green-400 transition" href="#productos">Productos</a>
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
                    <div class="flex items-center gap-2">
                        <span class="material-icons-outlined text-green-700 dark:text-green-400 text-3xl">eco</span>
                        <span class="font-display font-bold text-xl text-green-900 dark:text-green-400">
                            golfer<span class="text-amber-500">T</span>
                        </span>
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
                        @click="closeMenu"
                        href="#productos"
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
                        © 2026 GolferT Fertilizantes
                    </p>
                </div>
            </div>
        </Transition>

        <!-- Hero Section -->
        <div id="inicio" class="relative bg-gray-900 overflow-hidden">
            <div class="absolute inset-0">
                <img alt="Farmer checking crops in a sunny field" class="w-full h-full object-cover" src="/images/hero2.png"/>
                <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 to-transparent dark:from-black/90 mix-blend-multiply"></div>
            </div>

            <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 h-[600px] flex flex-col justify-center">
                <h1
                    data-aos="fade-right"
                    data-aos-duration="1000"
                    class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl font-display mb-6 shadow-black drop-shadow-lg"
                >
                    Nutriendo el Campo, <br/>
                    <span class="text-amber-500">Impulsando tu Cosecha</span>
                </h1>

                <p
                    data-aos="fade-right"
                    data-aos-duration="1000"
                    data-aos-delay="200"
                    class="mt-2 text-xl text-gray-100 max-w-3xl font-light"
                >
                    Fertilizantes de Alta Eficiencia diseñados tecnológicamente para maximizar el rendimiento de tus cultivos.
                </p>

                <div class="mt-10" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                    <a class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-md shadow-lg transition transform hover:-translate-y-1 text-lg" href="#productos">
                        Ver Productos
                    </a>
                </div>
            </div>

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
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-3xl font-extrabold text-white font-display inline-block border-b-2 border-amber-500 pb-2">Líneas de Productos</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        data-aos="flip-left"
                        data-aos-duration="800"
                        class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-2xl transform transition hover:scale-105"
                    >
                        <div class="h-48 bg-gray-100 dark:bg-gray-700 flex items-center justify-center p-4">
                            <img alt="Botella de fertilizante Golferfol" class="h-full object-contain drop-shadow-lg" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkDLa8SSIg37Y0CkBAebzh-8x6huADkvJ6w6ZGzn9iGh0hFHlNu6-ibGjvUwrP8qYRWrTAvIBpRP4yDYCBk8G014hyo-t93Wz4-Z_oQYdM2DhYUAIZ_bg_AZadxKWjQH3NYhqqB7-78GEgBTkBQGT-S_CXrSdqC90pSIcnkicItLH5KaDYwN4xp7YtFnozzNm5xDZvrcynINY81ybesKfMfoVQJMASaMta4Ux5dS_ilH5D3H1mLuPVcsQRMC6YY_1JnpO7VVaf-TWk"/>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-lg font-bold text-green-900 dark:text-white font-display">GOLFERFOL</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Línea Foliar Premium</p>
                            <button class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-6 rounded w-full transition">Ver Más</button>
                        </div>
                    </div>

                    <div
                        data-aos="flip-left"
                        data-aos-duration="800"
                        data-aos-delay="100"
                        class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-2xl transform transition hover:scale-105"
                    >
                        <div class="h-48 bg-gray-100 dark:bg-gray-700 flex items-center justify-center p-4">
                            <img alt="Botella de fertilizante Golfer Reax" class="h-full object-contain drop-shadow-lg" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBaM7CAHA1r6KvtpZP4dRXqg5-Hot9FCibou5blzrZp2z_MRs6QQGe08Fi4Q5FDM427nYTUyCDtavd5zBbpxAcWDrhKuqa15bG26Ze1exwccE-6Wq9FoiOg5Crrl7p69wFrTTmyt3jhFjpTnp3L1Dc1u7OTQXdPQeCIfJd7STSt-zpwp_xJeDQ3dLaG_L0BuQ4FhdP3CdUu3vvy49mXrJnLADmFwBsHgq7Dqk162Jr4bDByWJ2ce6_tiU9LKPCpRGtno-c2dyPbCYAa"/>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-lg font-bold text-green-900 dark:text-white font-display">GOLFER REAX</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Bioestimulantes Avanzados</p>
                            <button class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-6 rounded w-full transition">Ver Más</button>
                        </div>
                    </div>

                    <div
                        data-aos="flip-left"
                        data-aos-duration="800"
                        data-aos-delay="200"
                        class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-2xl transform transition hover:scale-105"
                    >
                        <div class="h-48 bg-gray-100 dark:bg-gray-700 flex items-center justify-center p-4">
                            <img alt="Botella de fertilizante Golfer Mix" class="h-full object-contain drop-shadow-lg" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCffLimxh026eZmgxaJ9JFZ5RNAQ-i6MUFpmsSKWBOj5vGXJJHRSwjSkVeoe0OsyIERNt8ulSSai4n36IpElpffxwKY8uKLuWCVuJvnZw1h3uIj-L-HcvayrkXz_h0I2Jo9gkSCZODe2fKOfmEfiVZ7qvC7lOjitNLk-CLm3HdP_kY8gIaD2l1TPnXwJH0EyGeItzPIOmi2VynG5PWSQXpM7bwpQNcwTQWcl0-r_Bd1PK7S6dvEhikN7TIZOwmCwk05M_KaYyPtvOd2"/>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-lg font-bold text-green-900 dark:text-white font-display">GOLFER.MIX</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Correctores de Carencias</p>
                            <button class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-6 rounded w-full transition">Ver Más</button>
                        </div>
                    </div>
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
                            <button class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-bold text-white bg-green-700 dark:bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors" type="submit">
                                Enviar Mensaje
                                <span class="material-icons-outlined ml-2">send</span>
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
                        <div class="flex items-center gap-2 mb-4">
                            <span class="material-icons-outlined text-amber-500 text-3xl">eco</span>
                            <span class="font-display font-bold text-xl tracking-tight">golfer<span class="text-amber-500">T</span></span>
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
                        </div>
                    </div>

                    <!-- Información de Contacto -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-200 tracking-wider uppercase mb-4">Contacto</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="material-icons-outlined text-amber-500 text-xl">phone</span>
                                <div>
                                    <p class="text-gray-400 text-sm">Teléfono</p>
                                    <a :href="'tel:' + contactInfo.phone.replace(/\D/g,'')" class="text-white hover:text-amber-500 transition">{{ contactInfo.phone }}</a>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-icons-outlined text-amber-500 text-xl">email</span>
                                <div>
                                    <p class="text-gray-400 text-sm">Email</p>
                                    <a :href="'mailto:' + contactInfo.email" class="text-white hover:text-amber-500 transition">{{ contactInfo.email }}</a>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-icons-outlined text-amber-500 text-xl">location_on</span>
                                <div>
                                    <p class="text-gray-400 text-sm">Dirección</p>
                                    <p class="text-white text-sm">{{ contactInfo.address }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Horarios de Atención -->
                    <div>
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
                    </div>

                    <!-- Enlaces Rápidos -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-200 tracking-wider uppercase mb-4">Enlaces Rápidos</h3>
                        <ul class="space-y-2">
                            <li><a class="text-gray-400 hover:text-white transition flex items-center gap-2" href="#inicio">
                                <span class="material-icons-outlined text-sm">arrow_forward</span>
                                Inicio
                            </a></li>
                            <li><a class="text-gray-400 hover:text-white transition flex items-center gap-2" href="#productos">
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
                            © 2026 GolferT Fertilizantes. Todos los derechos reservados.
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
    </div>
</template>

<script>
export default {
    name: 'Home',
    data() {
        return {
            mobileMenuOpen: false,
            form: {
                name: '',
                email: '',
                phone: '',
                message: ''
            },
            contactInfo: {
                phone: '+52 123 456 7890',
                email: 'info@golfert.com',
                address: 'Av. Principal #123, Ciudad, Estado, CP 12345',
                whatsapp: '+52 123 456 7890'
            },
            socialMedia: {
                facebook: 'https://www.facebook.com/profile.php?id=100054637500718',
                instagram: '#',
                twitter: '#',
                linkedin: '#'
            },
            schedule: {
                weekdays: 'Lunes - Viernes: 8:00 AM - 6:00 PM',
                saturday: 'Sábado: 9:00 AM - 2:00 PM',
                sunday: 'Domingo: Cerrado'
            }
        }
    },
    mounted() {
        // Inicializar AOS
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                once: true,
                offset: 100,
                easing: 'ease-in-out'
            });
        }

        // Smooth scroll para navegación
        this.setupSmoothScroll();
    },
    methods: {
        closeMenu() {
            this.mobileMenuOpen = false;
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
        handleSubmit() {
            console.log('Form submitted:', this.form);
            // Aquí puedes agregar la lógica para enviar el formulario
            alert('Mensaje enviado correctamente!');
            this.form = {
                name: '',
                email: '',
                phone: '',
                message: ''
            };
        }
    }
}
</script>

<style scoped>
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
