import './bootstrap';
import { createApp } from 'vue';
import axios from 'axios';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import App from './components/App.vue';

// Registrar plugin de GSAP
gsap.registerPlugin(ScrollTrigger);

// Configurar axios para usar CSRF token y credenciales
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.withCredentials = true; // Importante para sesiones
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

// Verificar si el elemento #app existe antes de crear la aplicación Vue
const appElement = document.getElementById('app');

if (appElement) {
    // Inicializar Vue con el componente App
    const app = createApp(App);

    // Montar la aplicación
    app.mount('#app');
}

// Animaciones GSAP personalizadas
document.addEventListener('DOMContentLoaded', () => {
    // Animación para el navbar al hacer scroll
    const navbar = document.querySelector('nav');
    if (navbar) {
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 100) {
                navbar.classList.add('shadow-xl');
            } else {
                navbar.classList.remove('shadow-xl');
            }

            lastScroll = currentScroll;
        });
    }

    // Animación parallax para el hero
    const heroImage = document.querySelector('#inicio img');
    if (heroImage) {
        gsap.to(heroImage, {
            scrollTrigger: {
                trigger: '#inicio',
                start: 'top top',
                end: 'bottom top',
                scrub: true
            },
            y: 200,
            ease: 'none'
        });
    }

    // Animación para las tarjetas de productos con efecto hover mejorado
    const productCards = document.querySelectorAll('[data-aos="flip-left"]');
    productCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            gsap.to(card, {
                y: -10,
                boxShadow: '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                y: 0,
                boxShadow: '0 20px 25px -5px rgba(0, 0, 0, 0.1)',
                duration: 0.3,
                ease: 'power2.out'
            });
        });
    });

    // Contador animado para números (si hay estadísticas)
    const animateNumbers = (element, target) => {
        gsap.to(element, {
            scrollTrigger: {
                trigger: element,
                start: 'top 80%'
            },
            innerText: target,
            duration: 2,
            snap: { innerText: 1 },
            ease: 'power1.out'
        });
    };

    // Aplicar a elementos con clase .counter si existen
    document.querySelectorAll('.counter').forEach(counter => {
        const target = parseInt(counter.dataset.target);
        animateNumbers(counter, target);
    });
});
