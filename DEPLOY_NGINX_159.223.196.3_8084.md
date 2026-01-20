## Deploy (Laravel 12 + Vite/Vue) en Nginx para goldfert.com

> **Objetivo**: servir tu Laravel en producción con **Nginx** en el dominio **goldfert.com**, con PHP-FPM (PHP 8.3), PostgreSQL y permisos de root.  
> Este documento asume Ubuntu/Debian. Ajusta rutas/paquetes si tu distro cambia.

---

## 1) Requisitos en el servidor

Instala Nginx, PHP-FPM 8.3 y extensiones típicas de Laravel con soporte para PostgreSQL:

```bash
sudo apt update
sudo apt install -y nginx php8.3-fpm php8.3-cli php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-bcmath php8.3-gd php8.3-pgsql postgresql postgresql-contrib unzip git curl
```

Instala Composer globalmente:

```bash
# Descargar e instalar Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer

# Verificar instalación
composer --version
```

Instala Node.js y npm (solo para build de assets con Vite).  
En producción, Node puede existir solo durante el build (luego no hace falta para servir):

```bash
# Opción 1: Usando NodeSource (recomendado para versiones recientes)
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs

# Opción 2: O usando el repositorio de Ubuntu
# sudo apt install -y nodejs npm

# Verificar instalación
node --version
npm --version
```

---

## 2) Montaje del proyecto en el servidor

Ejemplo con ruta estándar:

```bash
sudo mkdir -p /var/www/goldfert
sudo chown -R root:root /var/www/goldfert
```

Clona/copia tu proyecto dentro de `/var/www/goldfert` (ajusta el método según tu flujo):

```bash
cd /var/www/goldfert
# git clone <tu-repo> .
```

Permisos con root (Laravel necesita escribir en `storage/` y `bootstrap/cache/`):

```bash
sudo chown -R root:root /var/www/goldfert
sudo chmod -R 755 /var/www/goldfert
sudo chmod -R 775 /var/www/goldfert/storage /var/www/goldfert/bootstrap/cache
```

---

## 3) `.env` de producción (lo mínimo)

Crea tu `.env` en el servidor (basado en `.env.example`) y ajusta claves:

```bash
cd /var/www/goldfert
cp .env.example .env
```

Valores clave para tu caso (dominio goldfert.com):

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://goldfert.com` (o `http://goldfert.com` si no tienes SSL aún)

Y configura DB, mail, etc. (según tu servidor). Ejemplo de base con PostgreSQL:

```ini
APP_NAME="Goldfert"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://goldfert.com

LOG_CHANNEL=stack

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=goldfert
DB_USERNAME=postgres
DB_PASSWORD=tu_password_postgres
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

## 6) Nginx: crear sitio para goldfert.com

### 6.1 Crear el server block

Crea el archivo:

```bash
sudo nano /etc/nginx/sites-available/goldfert
```

Contenido recomendado para HTTP (puerto 80):

```nginx
server {
    listen 80;
    listen [::]:80;

    server_name goldfert.com www.goldfert.com;
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
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT $realpath_root;
        fastcgi_read_timeout 120;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_log  /var/log/nginx/goldfert_error.log;
    access_log /var/log/nginx/goldfert_access.log;
}
```

**Nota**: Si tienes SSL/HTTPS configurado, agrega un bloque adicional para el puerto 443 o usa Let's Encrypt con Certbot.

### 6.2 Crear el "enlace con ngx" (sites-enabled)

```bash
sudo ln -s /etc/nginx/sites-available/goldfert /etc/nginx/sites-enabled/goldfert
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

## 7) Abrir puertos HTTP/HTTPS (firewall)

Si usas UFW:

```bash
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw status
```

---

## 8) Servicios (PHP-FPM / Nginx)

Asegura servicios activos:

```bash
sudo systemctl enable --now php8.3-fpm
sudo systemctl enable --now nginx
```

---

## 9) Checklist rápido de verificación

- La app carga en: `http://goldfert.com` (o `https://goldfert.com` si tienes SSL)
- `APP_URL` coincide con la URL del dominio
- Permisos correctos en `storage/` y `bootstrap/cache/` (root:root)
- `public/build/` existe (resultado de `npm run build`)
- `nginx -t` OK y Nginx recargado
- PostgreSQL está corriendo y la base de datos `goldfert` existe
- El DNS apunta `goldfert.com` a la IP del servidor

---

## Notas útiles (por si algo falla)

- Si recibes 502/504: revisa `php8.3-fpm` y el socket `unix:/run/php/php8.3-fpm.sock`.
- Si ves CSS/JS rotos: asegúrate de haber corrido `npm run build` y que Nginx apunte a `public/`.
- Si cambias `.env` en prod: vuelve a correr `php artisan config:cache`.
- Si hay problemas de conexión a PostgreSQL: verifica que el servicio esté activo (`sudo systemctl status postgresql`) y que las credenciales en `.env` sean correctas.
- Para verificar permisos: `ls -la /var/www/goldfert/storage` debe mostrar `root:root`.
- Si el dominio no resuelve: verifica que el DNS apunte correctamente a la IP del servidor.
