## Deploy (Laravel 12 + Vite/Vue) en Nginx apuntando a `159.223.196.3:8084`

> **Objetivo**: servir tu Laravel en producción con **Nginx** escuchando en **puerto 8084**, en la IP **159.223.196.3**, y con PHP-FPM (PHP 8.2).  
> Este documento asume Ubuntu/Debian. Ajusta rutas/paquetes si tu distro cambia.

---

## 1) Requisitos en el servidor

Instala Nginx, PHP-FPM 8.2 y extensiones típicas de Laravel:

```bash
sudo apt update
sudo apt install -y nginx \
  php8.2-fpm php8.2-cli php8.2-mbstring php8.2-xml php8.2-curl php8.2-zip php8.2-bcmath php8.2-gd \
  php8.2-mysql \
  unzip git
```

Instala Composer (si no está) y Node (solo para build de assets con Vite).  
En producción, Node puede existir solo durante el build (luego no hace falta para servir).

---

## 2) Montaje del proyecto en el servidor

Ejemplo con ruta estándar:

```bash
sudo mkdir -p /var/www/goldfert
sudo chown -R $USER:www-data /var/www/goldfert
```

Clona/copia tu proyecto dentro de `/var/www/goldfert` (ajusta el método según tu flujo):

```bash
cd /var/www/goldfert
# git clone <tu-repo> .
```

Permisos recomendados (Laravel necesita escribir en `storage/` y `bootstrap/cache/`):

```bash
sudo chown -R www-data:www-data /var/www/goldfert/storage /var/www/goldfert/bootstrap/cache
sudo chmod -R 775 /var/www/goldfert/storage /var/www/goldfert/bootstrap/cache
```

---

## 3) `.env` de producción (lo mínimo)

Crea tu `.env` en el servidor (basado en `.env.example`) y ajusta claves:

```bash
cd /var/www/goldfert
cp .env.example .env
```

Valores clave para tu caso (IP + puerto):

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=http://159.223.196.3:8084`

Y configura DB, mail, etc. (según tu servidor). Ejemplo de base:

```ini
APP_NAME="Goldfert"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=http://159.223.196.3:8084

LOG_CHANNEL=stack

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=goldfert
DB_USERNAME=si
DB_PASSWORD=si270620*
```

Genera la key:

```bash
cd /var/www/goldfert
php artisan key:generate
```

---

## 4) Instalar dependencias y compilar assets (Vite)

Composer (sin dev, optimizado):

```bash
cd /var/www/goldfert
composer install --no-dev --optimize-autoloader
```

Node/Vite build:

```bash
cd /var/www/goldfert
npm ci
npm run build
```

---

## 5) Laravel: migraciones, storage link y cache de config/routes/views

Storage symlink:

```bash
cd /var/www/goldfert
php artisan storage:link
```

Migraciones en producción:

```bash
cd /var/www/goldfert
php artisan migrate --force
```

Cache de configuración (recomendado en producción):

```bash
cd /var/www/goldfert
php artisan config:cache
php artisan route:cache || true
php artisan view:cache || true
```

---

## 6) Nginx: crear sitio, “enlace con ngx” (symlink) y escuchar en `8084`

### 6.1 Crear el server block

Crea el archivo:

```bash
sudo nano /etc/nginx/sites-available/goldfert_8084
```

Contenido recomendado (ajusta `server_name` si luego usas dominio):

```nginx
server {
    listen 8084;
    listen [::]:8084;

    server_name 159.223.196.3;
    root /var/www/goldfert/public;
    index index.php index.html;

    charset utf-8;
    client_max_body_size 20M;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Evitar exponer archivos sensibles
    location ~ /\.(?!well-known).* {
        deny all;
    }

    location ~* \.(?:css|js|jpg|jpeg|gif|png|svg|ico|webp|woff2?)$ {
        expires 30d;
        access_log off;
        add_header Cache-Control "public";
        try_files $uri /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT $realpath_root;
        fastcgi_read_timeout 120;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_log  /var/log/nginx/goldfert_8084_error.log;
    access_log /var/log/nginx/goldfert_8084_access.log;
}
```

### 6.2 Crear el “enlace con ngx” (sites-enabled)

```bash
sudo ln -s /etc/nginx/sites-available/goldfert_8084 /etc/nginx/sites-enabled/goldfert_8084
```

Opcional: deshabilita el default si estorba:

```bash
sudo rm -f /etc/nginx/sites-enabled/default
```

Validar y recargar:

```bash
sudo nginx -t
sudo systemctl reload nginx
```

---

## 7) Abrir el puerto 8084 (firewall)

Si usas UFW:

```bash
sudo ufw allow 8084/tcp
sudo ufw status
```

---

## 8) Servicios (PHP-FPM / Nginx)

Asegura servicios activos:

```bash
sudo systemctl enable --now php8.2-fpm
sudo systemctl enable --now nginx
```

---

## 9) Checklist rápido de verificación

- La app carga en: `http://159.223.196.3:8084`
- `APP_URL` coincide con `http://159.223.196.3:8084`
- Permisos correctos en `storage/` y `bootstrap/cache/`
- `public/build/` existe (resultado de `npm run build`)
- `nginx -t` OK y Nginx recargado

---

## Notas útiles (por si algo falla)

- Si recibes 502/504: revisa `php8.2-fpm` y el socket `unix:/run/php/php8.2-fpm.sock`.
- Si ves CSS/JS rotos: asegúrate de haber corrido `npm run build` y que Nginx apunte a `public/`.
- Si cambias `.env` en prod: vuelve a correr `php artisan config:cache`.
