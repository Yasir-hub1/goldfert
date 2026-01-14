// Helper Functions para GOLDfert

/**
 * Extrae el ID del video de una URL de TikTok
 * @param {string} url - URL completa del video de TikTok
 * @returns {string|null} - ID del video o null si no se encuentra
 */
export const extractTikTokVideoId = (url) => {
    // Limpiar la URL de parámetros de query
    const cleanUrl = url.split('?')[0];

    // Patrones para diferentes formatos de URL de TikTok
    const patterns = [
        /tiktok\.com\/@[\w.-]+\/video\/(\d+)/,  // Formato: @usuario/video/ID
        /tiktok\.com\/v\/(\d+)/,                  // Formato corto: /v/ID
        /vm\.tiktok\.com\/(\w+)/,                 // Formato muy corto
        /vt\.tiktok\.com\/(\w+)/,                 // Otro formato corto
    ];

    for (const pattern of patterns) {
        const match = cleanUrl.match(pattern);
        if (match && match[1]) {
            return match[1];
        }
    }

    // Si la URL ya es solo el ID
    if (/^\d+$/.test(cleanUrl)) {
        return cleanUrl;
    }

    return null;
};

/**
 * Genera la URL de embed oficial de TikTok (formato blockquote)
 * @param {string} videoUrl - URL del video de TikTok
 * @returns {string} - URL limpia para embed
 */
export const generateTikTokEmbedUrl = (videoUrl) => {
    // Limpiar la URL de parámetros de query para el embed
    const cleanUrl = videoUrl.split('?')[0];
    return cleanUrl;
};

// Videos de TikTok de productos y demostraciones
// URLs reales de los videos de TikTok
export const tiktokVideos = [
    {
        id: 1,
        url: 'https://www.tiktok.com/@erwinruiz2/video/7568217499553058104',
        title: 'Productos GOLDfert en acción',
        description: 'Aplicación de fertilizantes en campo'
    },
    {
        id: 2,
        url: 'https://www.tiktok.com/@erwinruiz2/video/7562152360596835596',
        title: 'Resultados con CALBORZINC',
        description: 'Efectos visibles en cultivos'
    },
    {
        id: 3,
        url: 'https://www.tiktok.com/@erwinruiz2/video/7550816924800650502',
        title: 'Testimonios de agricultores',
        description: 'Experiencias reales con nuestros productos'
    },
    {
        id: 4,
        url: 'https://www.tiktok.com/@erwinruiz2/video/7534083507316854021',
        title: 'Aplicación de SULFERT',
        description: 'Técnicas de aplicación correcta'
    },
    {
        id: 5,
        url: 'https://www.tiktok.com/@erwinruiz2/video/7520394188609916165',
        title: 'VITAL Mix en campo',
        description: 'Bioestimulante en acción'
    },
    {
        id: 6,
        url: 'https://www.tiktok.com/@erwinruiz2/video/7509607954790862086',
        title: 'Comparativa de resultados',
        description: 'Antes y después con GOLDfert'
    },
    {
        id: 7,
        url: 'https://www.tiktok.com/@erwinruiz2/video/7505454487121726725',
        title: 'Consejos agrícolas',
        description: 'Tips para mejores cosechas'
    },
    {
        id: 8,
        url: 'https://www.tiktok.com/@erwinruiz2/video/7482449073375644934',
        title: 'Nuevos productos',
        description: 'Lanzamientos y novedades'
    }
].map(video => ({
    ...video,
    embedUrl: generateTikTokEmbedUrl(video.url),
    videoId: extractTikTokVideoId(video.url)
}));

// Información de contacto con WhatsApp
export const contactPhones = [
    {
        number: '71616724',
        display: '71616724',
        countryCode: '591',
        whatsappLink: 'https://wa.me/59171616724'
    },
    {
        number: '78000965',
        display: '78000965',
        countryCode: '591',
        whatsappLink: 'https://wa.me/59178000965'
    }
];

/**
 * Formatea un número de teléfono eliminando caracteres no numéricos
 * @param {string} phone - Número de teléfono
 * @returns {string} - Número limpio
 */
export const formatPhone = (phone) => {
    return phone.replace(/\D/g, '');
};

/**
 * Genera un link de WhatsApp con mensaje opcional
 * @param {string} phone - Número de teléfono (con o sin código de país)
 * @param {string} message - Mensaje predeterminado (opcional)
 * @returns {string} - URL de WhatsApp
 */
export const generateWhatsAppLink = (phone, message = '') => {
    const cleanPhone = formatPhone(phone);
    const encodedMessage = encodeURIComponent(message);
    // Asume código de país 591 (Bolivia) si no está incluido
    const fullPhone = cleanPhone.startsWith('591') ? cleanPhone : `591${cleanPhone}`;
    return `https://wa.me/${fullPhone}${message ? `?text=${encodedMessage}` : ''}`;
};

/**
 * Carga el script de embed de TikTok
 * @returns {Promise} - Promesa que se resuelve cuando el script está cargado
 */
export const loadTikTokEmbedScript = () => {
    return new Promise((resolve, reject) => {
        // Verificar si ya está cargado
        if (window.tiktokEmbed) {
            resolve();
            return;
        }

        // Verificar si el script ya existe
        const existingScript = document.querySelector('script[src*="tiktok.com/embed.js"]');
        if (existingScript) {
            if (window.tiktokEmbed) {
                resolve();
            } else {
                existingScript.addEventListener('load', resolve);
                existingScript.addEventListener('error', reject);
            }
            return;
        }

        // Crear y cargar el script
        const script = document.createElement('script');
        script.src = 'https://www.tiktok.com/embed.js';
        script.async = true;
        script.onload = () => {
            // Esperar un poco para que TikTok inicialice
            setTimeout(() => {
                if (window.tiktokEmbed) {
                    resolve();
                } else {
                    // Intentar de nuevo después de un segundo
                    setTimeout(resolve, 1000);
                }
            }, 100);
        };
        script.onerror = reject;
        document.body.appendChild(script);
    });
};
