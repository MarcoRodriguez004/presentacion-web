<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
import Swal from 'sweetalert2';
import ContactForm from '../Components/ContactForm.vue';
import { trackEvent } from '../utils/analytics';

interface TechItem {
    name: string;
    usage: string;
    tag: string;
}

interface StackGroup {
    id: string;
    label: string;
    short: string;
    color: string;
    items: TechItem[];
}

interface Principle {
    number: string;
    title: string;
    text: string;
}

interface Experience {
    id: string;
    company: string;
    project: string;
    role: string;
    period: string;
    location: string;
    category: string;
    color: string;
    headline: string;
    description: string;
    highlights: string[];
    stack: string[];
}

interface Contact {
    label: string;
    value: string;
    href: string;
    external?: boolean;
}

const props = defineProps<{
    profile: {
        name: string;
        shortName: string;
        role: string;
        specialty: string;
        summary: string;
        location: string;
        english: string;
    };
    facts: { value: string; label: string }[];
    stack: StackGroup[];
    experience: Experience[];
    principles: Principle[];
    contacts: Contact[];
}>();

const activeGroup = ref(props.stack[0]?.id ?? 'backend');
const menuOpen = ref(false);
const isVisible = ref(false);
const isCarouselPaused = ref(false);
let carouselTimer: ReturnType<typeof setInterval> | null = null;
const emailAddress = 'marco.rh004@gmail.com';

const activeStack = computed(() => props.stack.find((group) => group.id === activeGroup.value) ?? props.stack[0]);

const stopCarousel = () => {
    if (carouselTimer) {
        clearInterval(carouselTimer);
        carouselTimer = null;
    }
};

const startCarousel = () => {
    stopCarousel();
    isCarouselPaused.value = false;
    carouselTimer = setInterval(() => {
        const currentIndex = props.stack.findIndex((group) => group.id === activeGroup.value);
        const nextGroup = props.stack[(currentIndex + 1) % props.stack.length];

        if (nextGroup) {
            activeGroup.value = nextGroup.id;
        }
    }, 5000);
};

const pauseCarousel = () => {
    stopCarousel();
    isCarouselPaused.value = true;
};

const selectGroup = (id: string) => {
    activeGroup.value = id;
    trackEvent('stack_category_selected', { category: id });
    startCarousel();
};

const closeMenu = () => {
    menuOpen.value = false;
};

const openEmail = async () => {
    const result = await Swal.fire({
        title: '¿Abrir tu cliente de correo?',
        html: 'Se abrirá Outlook u otra aplicación configurada para escribir a <strong>' + emailAddress + '</strong>.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Abrir correo',
        cancelButtonText: 'Cancelar',
        reverseButtons: true,
        focusCancel: true,
        buttonsStyling: false,
        customClass: {
            popup: 'portfolio-alert',
            confirmButton: 'portfolio-alert-confirm',
            cancelButton: 'portfolio-alert-cancel',
        },
    });

    if (result.isConfirmed) {
        trackEvent('email_client_opened');
        window.location.href = 'mailto:' + emailAddress;
    }
};

const handleContactClick = (contact: Contact, event: MouseEvent) => {
    if (contact.label === 'Email') {
        event.preventDefault();
        openEmail();
    } else if (contact.external) {
        trackEvent('whatsapp_click');
    }
};

onMounted(() => {
    requestAnimationFrame(() => {
        isVisible.value = true;
    });
    startCarousel();
});

onBeforeUnmount(stopCarousel);
</script>

<template>
    <div class="min-h-screen overflow-hidden bg-paper text-ink" :class="{ 'page-ready': isVisible }">
        <header class="absolute inset-x-0 top-0 z-30 border-b border-white/15">
            <div class="mx-auto flex min-h-[82px] w-[min(1180px,calc(100%-40px))] items-center justify-between">
                <a href="#inicio" class="flex items-center gap-3" @click="closeMenu">
                    <span class="font-display text-lg font-extrabold tracking-[-0.08em]">MR<span class="text-acid">.</span></span>
                    <span class="hidden font-mono text-[9px] uppercase leading-tight tracking-[0.12em] text-white/55 sm:block">Presentación<br>profesional</span>
                </a>

                <button
                    type="button"
                    class="flex h-10 w-10 flex-col items-center justify-center gap-1.5 border border-white/20 text-paper md:hidden"
                    :aria-expanded="menuOpen"
                    aria-controls="main-navigation"
                    aria-label="Abrir navegación"
                    @click="menuOpen = !menuOpen"
                >
                    <span class="block h-px w-4 bg-current"></span>
                    <span class="block h-px w-4 bg-current"></span>
                </button>

                <nav
                    id="main-navigation"
                    class="absolute left-0 right-0 top-[82px] hidden flex-col gap-0 border-b border-white/15 bg-ink px-5 pb-5 md:static md:flex md:flex-row md:items-center md:gap-7 md:border-0 md:bg-transparent md:p-0"
                    :class="{ '!flex': menuOpen }"
                    aria-label="Navegación principal"
                >
                    <a class="nav-link" href="#inicio" @click="closeMenu">Inicio</a>
                    <a class="nav-link" href="#stack" @click="closeMenu">Stack</a>
                    <a class="nav-link" href="#experiencia" @click="closeMenu">Casos</a>
                    <a class="nav-link" href="#metodo" @click="closeMenu">Método</a>
                    <a class="nav-link" href="#contacto" @click="closeMenu">Contacto</a>
                    <span class="availability-pill hidden items-center gap-2 font-mono text-[9px] uppercase tracking-[.05em] text-white/55 lg:inline-flex"><i class="h-1.5 w-1.5 rounded-full bg-acid"></i> Disponible</span>
                    <a class="mt-4 inline-flex items-center justify-between gap-4 bg-acid px-3.5 py-2.5 font-mono text-[10px] uppercase tracking-[0.04em] text-ink transition hover:bg-[#e8ff90] md:mt-0" href="/cv" @click="trackEvent('cv_download', { location: 'navigation' })">
                        Descargar CV <span aria-hidden="true">↗</span>
                    </a>
                </nav>
            </div>
        </header>

        <main>
            <section id="inicio" class="hero-section relative isolate overflow-hidden bg-ink text-paper">
                <div class="hero-grid absolute inset-0 -z-10 opacity-20"></div>
                <div class="absolute -right-40 -top-40 -z-10 h-[600px] w-[600px] rounded-full border border-acid/20 shadow-[0_0_0_40px_rgba(216,243,106,.035),0_0_0_80px_rgba(216,243,106,.02)]"></div>
                <div class="absolute -left-52 bottom-[-310px] -z-10 h-[560px] w-[560px] rounded-full bg-coral/10 blur-3xl"></div>

                <div class="mx-auto flex min-h-[760px] w-[min(1180px,calc(100%-40px))] flex-col justify-center pb-14 pt-36 sm:w-[min(1180px,calc(100%-64px))]">
                    <div class="grid items-center gap-20 lg:grid-cols-[1.12fr_.88fr]">
                        <div class="max-w-3xl transition-all duration-700" :class="isVisible ? 'translate-y-0 opacity-100' : 'translate-y-5 opacity-0'">
                            <p class="mb-7 flex items-center gap-2.5 font-mono text-[10px] uppercase tracking-[0.1em] text-acid"><span class="h-1.5 w-1.5 rounded-full bg-acid shadow-[0_0_0_5px_rgba(216,243,106,.11)]"></span> Presentación técnica / 2026</p>
                            <h1 class="font-display text-[clamp(3.25rem,8vw,7rem)] font-bold leading-[.92] tracking-[-.075em]">Construyo software<br><span class="text-acid">que tiene sentido.</span></h1>
                            <p class="mt-8 max-w-2xl text-base leading-8 text-[#bdcbc5] sm:text-lg">{{ props.profile.summary }}</p>
                            <div class="mt-10 flex flex-col items-start gap-6 sm:flex-row sm:items-center">
                                <a class="inline-flex min-w-[205px] items-center justify-between gap-7 bg-acid px-4 py-4 text-xs font-bold text-ink transition hover:-translate-y-0.5 hover:bg-[#e8ff90]" href="#experiencia">Ver casos reales <span aria-hidden="true">↓</span></a>
                                <a class="border-b border-paper pb-1 text-xs font-bold transition hover:gap-3 hover:text-coral" href="mailto:marco.rh004@gmail.com" @click.prevent="openEmail">Hablemos <span aria-hidden="true">↗</span></a>
                            </div>
                        </div>

                        <aside class="hero-console relative border border-white/25 bg-ink-soft/60 p-5 shadow-[24px_24px_0_rgba(216,243,106,.08)] transition-all delay-150 duration-700 sm:p-7" :class="isVisible ? 'translate-y-0 opacity-100' : 'translate-y-5 opacity-0'" aria-label="Mapa visual de mi forma de construir software">
                            <span class="absolute right-7 top-[-1px] h-[3px] w-10 bg-coral"></span>
                            <div class="flex items-center justify-between border-b border-white/15 pb-4 font-mono text-[9px] uppercase tracking-[.08em] text-white/55">
                                <span>// MARCO.RH / SYSTEM MAP</span>
                                <span class="inline-flex items-center gap-2 text-acid"><i class="status-dot h-1.5 w-1.5 rounded-full bg-current"></i> online</span>
                            </div>

                            <div class="hero-console-scene" aria-hidden="true">
                                <span class="hero-orbit hero-orbit-one"></span>
                                <span class="hero-orbit hero-orbit-two"></span>
                                <span class="hero-orbit hero-orbit-three"></span>
                                <span class="hero-connection connection-one"></span>
                                <span class="hero-connection connection-two"></span>
                                <span class="hero-connection connection-three"></span>
                                <span class="hero-node hero-node-api">API</span>
                                <span class="hero-node hero-node-data">DATA</span>
                                <span class="hero-node hero-node-ui">UI</span>
                                <span class="hero-node hero-node-security">SEC</span>
                                <div class="hero-console-core">
                                    <strong>MR</strong>
                                    <span>logic<br>first</span>
                                </div>
                            </div>

                            <div class="hero-console-code font-mono text-[11px] leading-7 text-[#dbe4df] sm:text-xs">
                                <span><i class="not-italic text-coral">const</i> system <b class="font-normal text-acid">=</b> {</span>
                                <span class="pl-5"><em class="not-italic text-blue">focus:</em> <strong class="font-normal text-acid">'business logic'</strong>,</span>
                                <span class="pl-5"><em class="not-italic text-blue">layers:</em> <strong class="font-normal text-acid">['data', 'UI', 'security']</strong></span>
                                <span>};</span>
                            </div>
                            <div class="mt-5 flex flex-col gap-2 border-t border-white/15 pt-4 font-mono text-[9px] uppercase tracking-[.04em] text-white/65 sm:flex-row sm:items-center sm:justify-between">
                                <span>Laravel + Vue.js</span>
                                <span class="inline-flex items-center gap-2"><i class="h-1.5 w-1.5 rounded-full bg-acid"></i> Estado de México</span>
                            </div>
                        </aside>
                    </div>

                    <div class="mt-20 flex flex-col items-start justify-between gap-5 font-mono text-[9px] uppercase tracking-[.08em] text-white/50 sm:flex-row sm:items-center">
                        <span class="flex items-center gap-3"><i class="h-px w-10 bg-acid"></i> Backend · frontend · datos · seguridad</span>
                        <span>Scroll para conocer el criterio</span>
                    </div>
                    <div class="mt-12 grid max-w-2xl grid-cols-1 gap-0 border-t border-white/15 sm:grid-cols-3">
                        <div v-for="fact in props.facts" :key="fact.label" class="border-b border-white/15 py-4 sm:border-b-0 sm:border-r sm:px-5 sm:first:pl-0 sm:last:border-r-0">
                            <p class="font-display text-lg font-bold tracking-[-.05em] text-paper">{{ fact.value }}</p>
                            <p class="mt-1 font-mono text-[9px] uppercase tracking-[.06em] text-white/45">{{ fact.label }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="signal-band border-y border-ink bg-acid text-ink" aria-label="Áreas de trabajo">
                <div class="signal-track flex w-max items-center gap-8 py-3 font-mono text-[10px] uppercase tracking-[.08em]" aria-hidden="true">
                    <span>lógica de negocio <b>✳</b></span><span>datos que cuentan una historia <b>✳</b></span><span>interfaces que orientan <b>✳</b></span><span>seguridad desde el diseño <b>✳</b></span>
                    <span>lógica de negocio <b>✳</b></span><span>datos que cuentan una historia <b>✳</b></span><span>interfaces que orientan <b>✳</b></span><span>seguridad desde el diseño <b>✳</b></span>
                </div>
            </div>

            <section id="stack" class="bg-paper py-24 sm:py-32">
                <div class="mx-auto w-[min(1180px,calc(100%-40px))] sm:w-[min(1180px,calc(100%-64px))]">
                    <div class="max-w-4xl">
                        <p class="section-kicker">01 / Tecnologías en contexto</p>
                        <h2 class="section-title">No colecciono herramientas.<br><span>Las conecto.</span></h2>
                        <p class="mt-7 max-w-2xl text-sm leading-7 text-muted sm:text-base">Mi stack está pensado para cubrir el recorrido completo: entender el problema, modelar la información, aplicar reglas de negocio, construir la interfaz y proteger el flujo.</p>
                    </div>

                    <div class="mt-16 grid gap-10 lg:grid-cols-[.72fr_1.28fr] lg:gap-20">
                        <div class="grid content-start gap-2">
                            <button
                                v-for="group in props.stack"
                                :key="group.id"
                                type="button"
                                class="group flex items-center justify-between border-b border-line px-0 py-5 text-left transition hover:px-3"
                                :class="activeGroup === group.id ? 'border-ink' : ''"
                                @click="selectGroup(group.id)"
                            >
                                <span class="flex items-center gap-3 text-base font-bold tracking-[-.04em]">
                                    <i class="h-2 w-2 rounded-full transition" :style="{ backgroundColor: group.color }"></i>
                                    {{ group.label }}
                                </span>
                                <span class="font-mono text-[10px] text-muted">{{ String(props.stack.indexOf(group) + 1).padStart(2, '0') }} <span class="ml-3 transition group-hover:ml-5">↗</span></span>
                            </button>
                            <p class="mt-8 max-w-xs font-mono text-[10px] uppercase leading-5 tracking-[.06em] text-muted">Selecciona una categoría para ver cómo uso cada pieza del stack.</p>
                        </div>

                        <Transition name="stack-panel" mode="out-in">
                            <div v-if="activeStack" :key="activeStack.id" class="relative min-h-[430px] border border-ink bg-ink p-6 text-paper sm:p-9" @mouseenter="pauseCarousel" @mouseleave="startCarousel">
                                <div class="flex items-start justify-between gap-5 border-b border-white/15 pb-7">
                                    <div>
                                        <p class="font-mono text-[10px] uppercase tracking-[.08em]" :style="{ color: activeStack.color }">{{ activeStack.label }}</p>
                                        <h3 class="mt-4 font-display text-3xl font-bold leading-none tracking-[-.07em] sm:text-4xl">{{ activeStack.short }}</h3>
                                    </div>
                                    <span class="font-mono text-xs text-white/40">{{ String(props.stack.indexOf(activeStack) + 1).padStart(2, '0') }} / 04</span>
                                </div>

                                <div class="grid gap-0 sm:grid-cols-2">
                                    <article v-for="item in activeStack.items" :key="item.name" class="border-b border-white/15 py-6 sm:pr-7 sm:[&:nth-child(even)]:pl-7 sm:[&:nth-child(even)]:pr-0 sm:[&:nth-child(odd)]:border-r">
                                        <div class="flex items-start justify-between gap-3">
                                            <h4 class="text-sm font-bold tracking-[-.03em]">{{ item.name }}</h4>
                                            <span class="font-mono text-[9px] uppercase tracking-[.05em] text-white/40">{{ item.tag }}</span>
                                        </div>
                                        <p class="mt-3 text-xs leading-6 text-white/55">{{ item.usage }}</p>
                                    </article>
                                </div>

                                <div class="absolute inset-x-0 bottom-0 h-0.5 bg-white/10" aria-hidden="true">
                                    <span class="carousel-progress block h-full origin-left bg-acid" :class="{ 'is-paused': isCarouselPaused }"></span>
                                </div>
                            </div>
                        </Transition>
                    </div>
                </div>
            </section>

            <section id="experiencia" class="case-section bg-ink py-24 text-paper sm:py-32">
                <div class="mx-auto w-[min(1180px,calc(100%-40px))] sm:w-[min(1180px,calc(100%-64px))]">
                    <div class="flex flex-col justify-between gap-8 border-b border-white/15 pb-12 md:flex-row md:items-end">
                        <div class="max-w-3xl">
                            <p class="section-kicker text-acid">02 / Experiencia en acción</p>
                            <h2 class="section-title mt-3 text-paper">Lo que dice mi CV.<br><span>Lo que resolví con él.</span></h2>
                        </div>
                        <p class="max-w-xs text-sm leading-7 text-white/55">Casos reales, problemas concretos y decisiones técnicas. Sin inventar métricas: el valor está en hacer visible el razonamiento.</p>
                    </div>

                    <div class="case-list">
                        <article v-for="(item, index) in props.experience" :key="item.id" class="case-card group" :style="{ '--case-color': item.color }">
                            <div class="case-card-number font-mono text-xs" aria-hidden="true">{{ String(index + 1).padStart(2, '0') }}</div>
                            <div class="case-card-main">
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 font-mono text-[9px] uppercase tracking-[.08em] text-white/45">
                                    <span :style="{ color: item.color }">{{ item.category }}</span>
                                    <span>{{ item.period }}</span>
                                </div>
                                <h3 class="mt-5 max-w-2xl font-display text-3xl font-bold leading-none tracking-[-.07em] sm:text-4xl">{{ item.headline }}</h3>
                                <p class="mt-5 max-w-2xl text-sm leading-7 text-white/60">{{ item.description }}</p>
                                <ul class="case-highlights mt-7 grid gap-3 text-xs leading-5 text-white/70 sm:grid-cols-2">
                                    <li v-for="highlight in item.highlights" :key="highlight">{{ highlight }}</li>
                                </ul>
                            </div>
                            <div class="case-card-meta">
                                <div class="case-card-company">
                                    <span class="font-mono text-[9px] uppercase tracking-[.08em] text-white/40">{{ item.company }}</span>
                                    <strong class="mt-2 block text-sm text-paper">{{ item.project }}</strong>
                                    <span class="mt-1 block text-xs text-white/45">{{ item.role }} · {{ item.location }}</span>
                                </div>
                                <div class="case-card-schematic" aria-hidden="true">
                                    <span>input</span><i></i><b :style="{ color: item.color, borderColor: item.color }">logic</b><i></i><span>result</span>
                                </div>
                                <div class="mt-7 flex flex-wrap gap-2">
                                    <span v-for="technology in item.stack" :key="technology" class="case-tech">{{ technology }}</span>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </section>

            <section id="metodo" class="border-y border-line bg-[#e8e5dc] py-24 sm:py-32">
                <div class="mx-auto w-[min(1180px,calc(100%-40px))] sm:w-[min(1180px,calc(100%-64px))]">
                    <div class="flex flex-col justify-between gap-8 md:flex-row md:items-end">
                        <div>
                            <p class="section-kicker">03 / Cómo trabajo</p>
                            <h2 class="section-title max-w-3xl">La herramienta cambia.<br><span>El criterio permanece.</span></h2>
                        </div>
                        <p class="max-w-xs text-sm leading-7 text-muted">Una buena implementación no es la que usa más tecnología, sino la que deja menos dudas al siguiente cambio.</p>
                    </div>

                    <div class="mt-16 grid gap-px bg-line md:grid-cols-3">
                        <article v-for="principle in props.principles" :key="principle.number" class="method-card relative min-h-[270px] overflow-hidden bg-paper-bright p-7 sm:p-9">
                            <span class="principle-number absolute right-6 top-4 font-display text-8xl font-extrabold leading-none text-ink/[.045]">{{ principle.number }}</span>
                            <span class="relative font-mono text-[10px] text-coral">{{ principle.number }}</span>
                            <h3 class="relative mt-20 max-w-[220px] text-2xl font-bold leading-none tracking-[-.06em]">{{ principle.title }}</h3>
                            <p class="relative mt-5 max-w-xs text-xs leading-6 text-muted">{{ principle.text }}</p>
                        </article>
                    </div>

                    <div class="mt-16 grid overflow-hidden border border-ink bg-ink lg:grid-cols-[.9fr_1.1fr]">
                        <div class="p-7 sm:p-10">
                            <p class="font-mono text-[10px] uppercase tracking-[.08em] text-acid">// FLUJO DE TRABAJO</p>
                            <h3 class="mt-8 max-w-md font-display text-3xl font-bold leading-tight tracking-[-.07em] text-paper sm:text-4xl">De la solicitud a una respuesta que se puede mantener.</h3>
                            <p class="mt-6 max-w-sm text-sm leading-7 text-white/55">Ordeno cada capa para que una regla de negocio no termine escondida dentro de una vista o una consulta imposible de leer.</p>
                        </div>
                        <div class="flex items-center border-t border-white/15 p-7 lg:border-l lg:border-t-0 sm:p-10">
                            <div class="w-full font-mono text-[10px] uppercase tracking-[.06em] sm:text-xs">
                                <div class="flow-step"><span>01</span><b>Request</b><em>Entrada clara</em></div>
                                <div class="flow-step"><span>02</span><b>Validate</b><em>Datos confiables</em></div>
                                <div class="flow-step"><span>03</span><b>Business rule</b><em>Decisión aislada</em></div>
                                <div class="flow-step"><span>04</span><b>Persist / query</b><em>Datos consistentes</em></div>
                                <div class="flow-step last"><span>05</span><b>Response</b><em>Resultado útil</em></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-ink py-24 text-paper sm:py-32">
                <div class="mx-auto w-[min(1180px,calc(100%-40px))] sm:w-[min(1180px,calc(100%-64px))]">
                    <div class="grid gap-14 lg:grid-cols-[.7fr_1.3fr] lg:gap-24">
                        <div>
                        <p class="section-kicker text-acid">04 / La visión completa</p>
                            <h2 class="section-title text-paper">Un sistema no termina en <span>el código.</span></h2>
                        </div>
                        <div class="grid gap-8 text-sm leading-7 text-white/60 sm:grid-cols-2">
                            <p>También importa cómo se validan los datos, cómo se comunica cada servicio, cómo se recupera un error y qué tan fácil resulta entender la decisión seis meses después.</p>
                            <p>Por eso complemento el desarrollo con SQL, Docker, Git, pruebas, automatización, cifrado, reportes PDF y herramientas para observar el comportamiento completo.</p>
                        </div>
                    </div>
                    <div class="mt-16 flex flex-wrap gap-2 border-t border-white/15 pt-8">
                        <span v-for="tool in ['Java 21', 'Spring Boot', 'SQL', 'Docker', 'Git', 'GitHub Actions', 'Gradle', 'Bash', 'PowerShell', 'JUnit', 'JaCoCo', 'JWT', 'mTLS', 'Puppeteer', 'Cheerio', 'Axios', 'React PDF', 'XLSX', 'CFDI']" :key="tool" class="border border-white/20 px-3 py-2 font-mono text-[10px] uppercase tracking-[.06em] text-white/65">{{ tool }}</span>
                    </div>
                </div>
            </section>

            <section id="contacto" class="bg-paper py-24 sm:py-32">
                <div class="mx-auto w-[min(1180px,calc(100%-40px))] sm:w-[min(1180px,calc(100%-64px))]">
                    <div class="grid gap-14 bg-coral p-7 sm:p-12 lg:grid-cols-[1fr_.82fr] lg:gap-24">
                        <div>
                        <p class="section-kicker text-ink">05 / Siguiente paso</p>
                            <h2 class="section-title max-w-2xl">¿Buscas a alguien que entienda <span>el sistema completo?</span></h2>
                            <p class="mt-7 max-w-lg text-base leading-8 text-ink/70">Estoy en {{ props.profile.location }}. Si mi forma de trabajar encaja con tu equipo, puedes escribirme o descargar mi CV.</p>
                        </div>
                        <div class="self-end border-t border-ink/25">
                            <a v-for="contact in props.contacts" :key="contact.label" class="flex items-center justify-between gap-3 border-b border-ink/25 py-5 text-sm font-bold transition hover:px-2 hover:text-paper" :href="contact.href" :target="contact.external ? '_blank' : undefined" rel="noopener noreferrer" @click="contact.label === 'CV' ? trackEvent('cv_download', { location: 'contact' }) : handleContactClick(contact, $event)">
                                <span class="w-20 font-mono text-[10px] uppercase tracking-[.06em] text-ink/60">{{ contact.label }}</span>
                                <span class="ml-auto text-right">{{ contact.value }}</span>
                                <span aria-hidden="true">↗</span>
                            </a>
                            <ContactForm />
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-line bg-paper">
            <div class="mx-auto flex min-h-20 w-[min(1180px,calc(100%-40px))] flex-col justify-center gap-2 py-5 font-mono text-[9px] uppercase tracking-[.06em] text-muted sm:w-[min(1180px,calc(100%-64px))] sm:flex-row sm:items-center sm:justify-between sm:py-0">
                <span>{{ props.profile.name }}</span>
                <span>{{ props.profile.role }} · {{ props.profile.specialty }}</span>
                <span>© 2026</span>
            </div>
        </footer>
    </div>
</template>
