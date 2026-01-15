import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            // Detectar el host desde variables de entorno para túneles
            detectTls: process.env.VITE_DETECT_TLS || false,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0', // Escuchar en todas las interfaces de red (necesario para túneles)
        port: 5173,
        strictPort: false, // Permitir usar otro puerto si 5173 está ocupado
        hmr: {
            // Detectar automáticamente el host desde variables de entorno o usar localhost
            host: process.env.VITE_HMR_HOST || process.env.VITE_DEV_SERVER_HOST || 'localhost',
            protocol: process.env.VITE_HMR_PROTOCOL || 'ws',
            clientPort: process.env.VITE_HMR_PORT ? parseInt(process.env.VITE_HMR_PORT) : 5173,
        },
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
        cors: {
            origin: true, // Permitir cualquier origen (útil para túneles de desarrollo)
            credentials: true,
        },
        // Configurar headers para evitar problemas de CORS
        headers: {
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers': 'Content-Type, Authorization',
        },
    },
});
