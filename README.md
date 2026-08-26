# Presentación técnica — Marco Rodríguez

Aplicación de presentación profesional construida para mostrar, de forma general, las tecnologías que uso y cómo las conecto en un sistema.

## Stack

- Laravel 12
- Inertia.js
- Vue 3
- TypeScript
- Tailwind CSS 4
- Vite
- SweetAlert2
- PHPUnit

La página no está organizada por proyectos. Explica mi forma de trabajar en backend, frontend, datos, DevOps, calidad y seguridad. El contenido se entrega desde PortfolioController como props de Inertia y la interacción del stack vive en resources/js/Pages/Home.vue.

## Requisitos

- PHP 8.2+
- Composer
- Node.js y npm

## Instalación

    composer install
    npm install

Si no existe el archivo .env:

    copy .env.example .env
    php artisan key:generate

## Levantar en desarrollo

En una terminal:

    php artisan serve

En otra terminal:

    npm run dev

Abre http://127.0.0.1:8000.

Para generar los assets de producción:

    npm run build

El enlace /cv descarga docs/CV-Marco-Rodriguez-2026.pdf mediante una ruta de Laravel.

## Despliegue en Vercel

El proyecto incluye `vercel.json` y `api/index.php` para ejecutar Laravel mediante el runtime PHP comunitario de Vercel. El build se ejecuta con `npm ci && npm run build`.

En Vercel configura como mínimo estas variables de entorno para Production:

    APP_ENV=production
    APP_DEBUG=false
    APP_KEY=tu_clave_generada_con_php_artisan_key:generate
    APP_URL=https://tu-dominio.vercel.app
    ASSET_URL=https://tu-dominio.vercel.app
    SESSION_DRIVER=cookie
    CACHE_STORE=array
    LOG_CHANNEL=stderr
    CONTACT_RECIPIENT=marco.rh004@gmail.com

No uses `SESSION_DRIVER=file` ni `CACHE_STORE=file` en Vercel: las funciones tienen un sistema de archivos efímero/no persistente. Para correo real también debes configurar un proveedor SMTP o una API de correo; `MAIL_MAILER=log` solo deja el mensaje en los logs de Vercel.

## Analítica

La integración con Plausible es opcional y solo se activa cuando PLAUSIBLE_DOMAIN tiene un dominio configurado en .env:

    PLAUSIBLE_DOMAIN=tu-dominio.com

Después de modificar .env:

    php artisan config:clear

Se prepararon eventos para descargas del CV, clics en WhatsApp y email, selección de categorías del stack y envío del formulario. Sin dominio configurado, la función de analítica no hace nada.

## Contacto

El formulario usa validación de Laravel, un campo honeypot anti-spam y rate limiting de 5 solicitudes cada 10 minutos por IP. El mailer local usa log, así que los mensajes se escriben en storage/logs/laravel.log.

Para enviar correos reales en producción hay que configurar MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD y CONTACT_RECIPIENT.

## SEO

La aplicación incluye metadatos Open Graph, canonical, Twitter Cards, JSON-LD de tipo Person, robots.txt y sitemap.xml.

## Validar

    php artisan test
