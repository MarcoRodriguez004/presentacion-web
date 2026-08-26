# Progreso del proyecto

Última actualización: 26 de agosto de 2026

## Estado actual

- Portafolio general construido con Laravel 12, Inertia.js, Vue 3, TypeScript, Tailwind CSS 4, Vite y SweetAlert2.
- La presentación está organizada por áreas técnicas y forma de trabajo, no por proyectos.
- Se agregaron animaciones al cambiar las tarjetas del stack y carrusel automático.
- El contacto de WhatsApp abre una conversación desde la sección de contacto.
- El formulario de contacto tiene validación de Laravel, campo honeypot y rate limiting.
- Se agregaron alertas visuales con SweetAlert2.
- Se agregaron eventos opcionales de analítica para CV, WhatsApp, email, stack y formulario.
- Se agregaron metadatos SEO, Open Graph, Twitter Cards, JSON-LD, `robots.txt` y `sitemap.xml`.
- El CV se descarga desde `docs/CV-Marco-Rodriguez-2026.pdf` mediante una ruta Laravel.

## Despliegue

- El proyecto está conectado a GitHub y Vercel.
- Vercel ejecuta Laravel mediante `vercel-php@0.9.0`.
- `vercel.json` define el build, `public` como salida, las rutas Laravel y las cachés temporales en `/tmp`.
- Se corrigió el error de Laravel `Target class [view] does not exist` configurando rutas compatibles con el sistema de archivos serverless.
- Se corrigió la pantalla blanca en producción forzando URLs HTTPS en `AppServiceProvider`; el problema era contenido mixto porque CSS y JavaScript se generaban con `http://`.
- Último commit publicado: `8df7759 fix: force HTTPS URLs on Vercel`.
- Las ramas remotas `dev` y `main` están sincronizadas en ese commit.
- Solo existe `dev` como rama local.

## Pendientes

1. Configurar correo real para el formulario.
   - Actualmente `MAIL_MAILER=log`; los mensajes solo aparecen en los logs de Vercel o en `storage/logs/laravel.log`.
   - No se guardan en base de datos y todavía no llegan al correo.
   - Elegir un proveedor transaccional, preferentemente Resend o Brevo, o configurar SMTP.
   - Configurar en Vercel las variables del proveedor, `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_SCHEME`, `MAIL_FROM_ADDRESS`, `MAIL_FROM_NAME` y `CONTACT_RECIPIENT`.
   - Probar envío real y confirmar entrega.

2. Confirmar y documentar el dominio público definitivo de producción en Vercel.
   - `presentacion-web.vercel.app` apunta a otra página y no debe compartirse.
   - Las URLs generadas de deployment pueden estar protegidas por Vercel Authentication.

3. Configurar o confirmar en Vercel las variables de producción:
   - `APP_ENV=production`
   - `APP_DEBUG=false`
   - `APP_KEY`
   - `APP_URL` y, si se conserva, `ASSET_URL` con HTTPS
   - `CONTACT_RECIPIENT`

4. Conectar Plausible u otra herramienta de analítica si se quieren métricas reales de visitas. Los eventos ya están preparados, pero la analítica está desactivada sin dominio configurado.

5. Opcional: añadir dominio personalizado, mejorar protección antispam y añadir pruebas end-to-end del formulario.

## Próximo paso recomendado

Configurar primero el proveedor de correo y probar el formulario en el dominio de producción. Es la única parte funcional importante que todavía no está conectada a un servicio real.
