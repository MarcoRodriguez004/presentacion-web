<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function index(): Response
    {
        $whatsappMessage = rawurlencode('Hola Marco, vi tu presentación profesional y me gustaría conversar contigo.');

        return Inertia::render('Home', [
            'profile' => [
                'name' => 'Marco Antonio Rodríguez Hernández',
                'shortName' => 'Marco Rodríguez',
                'role' => 'Desarrollador Fullstack',
                'specialty' => 'Laravel & Vue.js',
                'summary' => 'Construyo sistemas que conectan lógica de negocio, datos e interfaces claras. Mi trabajo combina backend, frontend, integraciones y seguridad para resolver problemas reales de principio a fin.',
                'location' => 'Estado de México, México',
                'english' => 'Inglés B2',
            ],
            'facts' => [
                ['value' => '04.2024 — 07.2026', 'label' => 'Experiencia reciente'],
                ['value' => 'Fullstack', 'label' => 'Perfil principal'],
                ['value' => 'REST + SQL', 'label' => 'Base de trabajo'],
            ],
            'stack' => [
                [
                    'id' => 'backend',
                    'label' => 'Backend & negocio',
                    'short' => 'Diseñar reglas claras y servicios que puedan crecer.',
                    'color' => '#d8f36a',
                    'items' => [
                        ['name' => 'PHP / Laravel', 'usage' => 'Construyo endpoints, servicios, validaciones, auditoría y lógica de negocio.', 'tag' => 'Core'],
                        ['name' => 'Java / Spring Boot', 'usage' => 'Estructuro APIs y capas de aplicación con Spring Boot, Data JPA y Security.', 'tag' => 'Servicios'],
                        ['name' => 'Node.js', 'usage' => 'Resuelvo integraciones y servicios con Express o NestJS cuando el contexto lo pide.', 'tag' => 'Integración'],
                        ['name' => 'REST API', 'usage' => 'Defino contratos entre sistemas para consultar, registrar y gestionar información.', 'tag' => 'Contrato'],
                    ],
                ],
                [
                    'id' => 'frontend',
                    'label' => 'Frontend & móvil',
                    'short' => 'Convertir flujos complejos en experiencias entendibles.',
                    'color' => '#9db4ff',
                    'items' => [
                        ['name' => 'Vue 3 / Quasar', 'usage' => 'Creo interfaces por componentes, formularios y flujos condicionales.', 'tag' => 'Principal'],
                        ['name' => 'React / Next.js', 'usage' => 'Construyo interfaces modernas con componentes reutilizables y TypeScript.', 'tag' => 'Alternativa'],
                        ['name' => 'TypeScript', 'usage' => 'Añado contratos al frontend para reducir errores y hacer el código más mantenible.', 'tag' => 'Tipos'],
                        ['name' => 'Tailwind CSS', 'usage' => 'Defino sistemas visuales consistentes y responsive desde los componentes.', 'tag' => 'UI'],
                    ],
                ],
                [
                    'id' => 'data',
                    'label' => 'Datos & DevOps',
                    'short' => 'Hacer que la información sea rápida, consistente y operable.',
                    'color' => '#ff775e',
                    'items' => [
                        ['name' => 'PostgreSQL / MySQL', 'usage' => 'Modelo información, normalizo estructuras y optimizo consultas e índices.', 'tag' => 'Datos'],
                        ['name' => 'TypeORM', 'usage' => 'Mapeo entidades y relaciones para trabajar con datos desde servicios Node.js.', 'tag' => 'ORM'],
                        ['name' => 'Docker', 'usage' => 'Estandarizo entornos para que desarrollo y despliegue sean reproducibles.', 'tag' => 'Entorno'],
                        ['name' => 'Git / GitHub Actions', 'usage' => 'Mantengo el historial del código y automatizo pasos de integración.', 'tag' => 'Flujo'],
                    ],
                ],
                [
                    'id' => 'quality',
                    'label' => 'Calidad & seguridad',
                    'short' => 'Proteger el sistema y verificar que se comporte como debe.',
                    'color' => '#f2efe8',
                    'items' => [
                        ['name' => 'JUnit / JaCoCo', 'usage' => 'Compruebo comportamiento y visibilidad de pruebas en servicios Java.', 'tag' => 'Testing'],
                        ['name' => 'JWT / mTLS', 'usage' => 'Trabajo con autenticación y comunicación segura entre servicios.', 'tag' => 'Auth'],
                        ['name' => 'Cifrado', 'usage' => 'Protejo payloads en tránsito con llaves individuales por servicio.', 'tag' => 'Seguridad'],
                        ['name' => 'Puppeteer / Axios', 'usage' => 'Automatizo recorridos e integraciones HTTP para validar flujos completos.', 'tag' => 'Automatización'],
                    ],
                ],
            ],
            'experience' => [
                [
                    'id' => 'zetus-pay',
                    'company' => 'ZETUS PAY',
                    'project' => 'Plataforma transaccional',
                    'role' => 'Desarrollador Backend',
                    'period' => '04.2026 — 07.2026',
                    'location' => 'México',
                    'category' => 'SECURITY / PAYMENTS',
                    'color' => '#d8f36a',
                    'headline' => 'Comunicación segura, datos mínimos.',
                    'description' => 'Actualicé la comunicación entre sistemas de una plataforma transaccional para terminales de pago, cuidando qué información cruza cada salto.',
                    'highlights' => [
                        'Payloads optimizados con solo los datos necesarios.',
                        'Llaves de cifrado individuales por servicio.',
                        'Cifrado y descifrado de payloads en tránsito.',
                    ],
                    'stack' => ['Payloads', 'Cifrado', 'Servicios', 'Seguridad'],
                ],
                [
                    'id' => 'conecta-sre',
                    'company' => 'INFOTEC / SRE',
                    'project' => 'CONECTA · Becas al extranjero',
                    'role' => 'Desarrollador Fullstack',
                    'period' => '01.2026 — 03.2026',
                    'location' => 'México',
                    'category' => 'PUBLIC SERVICE / FULLSTACK',
                    'color' => '#9db4ff',
                    'headline' => 'Reglas de negocio que cambian con el contexto.',
                    'description' => 'Construí módulos para convocatorias, candidaturas y documentos de un sistema nacional, conectando formularios, estados, requisitos y reportes.',
                    'highlights' => [
                        'Documentos y requisitos agrupados por etapa y estado.',
                        'Validaciones de activación y filtros por oferta académica.',
                        'Auditoría selectiva y reportes PDF con atención a privacidad.',
                    ],
                    'stack' => ['Vue.js', 'Quasar', 'Laravel', 'SQL', 'PDF'],
                ],
                [
                    'id' => 'sied',
                    'company' => 'DISEÑO E INTEGRACIÓN',
                    'project' => 'SIED · Expedientes digitales',
                    'role' => 'Programador Fullstack',
                    'period' => '01.2025 — 08.2025',
                    'location' => 'Estado de México',
                    'category' => 'DOCUMENT MANAGEMENT / API',
                    'color' => '#ff775e',
                    'headline' => 'El expediente se vuelve un flujo.',
                    'description' => 'Desarrollé módulos backend e integraciones para gestionar archivos digitales y exponer la información a la interfaz mediante contratos REST.',
                    'highlights' => [
                        'Módulos backend para gestión de archivos digitales.',
                        'APIs REST para consultar, registrar y gestionar información.',
                        'Listas negras integradas en el registro de aplicaciones.',
                    ],
                    'stack' => ['Laravel', 'Vue.js', 'REST API', 'MySQL'],
                ],
                [
                    'id' => 'conspiracion-moda',
                    'company' => 'DISEÑO E INTEGRACIÓN',
                    'project' => 'Conspiración Moda',
                    'role' => 'Programador Fullstack',
                    'period' => '04.2024 — 12.2024',
                    'location' => 'Texcoco, México',
                    'category' => 'ECOMMERCE / INTEGRATIONS',
                    'color' => '#f2efe8',
                    'headline' => 'Integrar sin frenar la operación.',
                    'description' => 'Conecté APIs externas de e-commerce y extendí la interfaz para que la operación pudiera consultar y mover información entre plataformas.',
                    'highlights' => [
                        'Integraciones REST con Shopify y Liverpool.',
                        'Nuevas vistas construidas con Vue.js.',
                        'Normalización e índices para mejorar la base MySQL.',
                    ],
                    'stack' => ['Vue.js', 'REST', 'Shopify', 'Liverpool', 'MySQL'],
                ],
            ],
            'principles' => [
                ['number' => '01', 'title' => 'Entender antes de construir', 'text' => 'Identifico el flujo, las reglas y los datos que realmente necesita el sistema.'],
                ['number' => '02', 'title' => 'Separar responsabilidades', 'text' => 'Mantengo la lógica de negocio, la persistencia y la interfaz con límites claros.'],
                ['number' => '03', 'title' => 'Hacer visible el riesgo', 'text' => 'Considero validación, privacidad, seguridad y mantenimiento desde el diseño.'],
            ],
            'contacts' => [
                ['label' => 'Email', 'value' => 'marco.rh004@gmail.com', 'href' => 'mailto:marco.rh004@gmail.com'],
                ['label' => 'WhatsApp', 'value' => '+52 55 6026 7244', 'href' => 'https://wa.me/525560267244?text='.$whatsappMessage, 'external' => true],
                ['label' => 'CV', 'value' => 'Descargar PDF 2026', 'href' => '/cv'],
            ],
        ]);
    }

    public function downloadCv()
    {
        $path = base_path('docs/CV-Marco-Rodriguez-2026.pdf');

        abort_unless(is_file($path), 404);

        return response()->download($path, 'CV-Marco-Rodriguez-2026.pdf');
    }
}
