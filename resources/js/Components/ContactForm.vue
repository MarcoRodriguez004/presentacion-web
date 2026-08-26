<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { trackEvent } from '../utils/analytics';

const form = useForm({
    name: '',
    email: '',
    message: '',
    website: '',
});

const submit = () => {
    form.post('/contact', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            trackEvent('contact_form_submitted');

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Mensaje enviado',
                text: 'Gracias por escribirme.',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                customClass: {
                    popup: 'portfolio-alert',
                },
            });
        },
    });
};
</script>

<template>
    <form class="mt-12 border-t border-ink/25 pt-8" novalidate @submit.prevent="submit">
        <div class="mb-6 flex items-end justify-between gap-4">
            <div>
                <p class="font-mono text-[9px] uppercase tracking-[.08em] text-ink/60">Contacto directo</p>
                <h3 class="mt-2 text-3xl font-bold tracking-[-.06em] text-ink sm:text-4xl">Hablemos de tu reto.</h3>
            </div>
            <span class="hidden font-mono text-[9px] uppercase tracking-[.05em] text-ink/50 sm:block">Laravel validation</span>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <label class="grid gap-2 text-sm font-bold text-ink">
                Nombre
                <input
                    v-model="form.name"
                    type="text"
                    name="name"
                    autocomplete="name"
                    placeholder="Tu nombre"
                    class="border bg-transparent px-4 py-4 text-sm font-normal outline-none transition placeholder:text-ink/40 focus:border-ink"
                    :class="form.errors.name ? 'border-coral' : 'border-ink/25'"
                >
                <span v-if="form.errors.name" class="text-xs font-normal text-ink">{{ form.errors.name }}</span>
            </label>

            <label class="grid gap-2 text-sm font-bold text-ink">
                Email
                <input
                    v-model="form.email"
                    type="email"
                    name="email"
                    autocomplete="email"
                    placeholder="tu@email.com"
                    class="border bg-transparent px-4 py-4 text-sm font-normal outline-none transition placeholder:text-ink/40 focus:border-ink"
                    :class="form.errors.email ? 'border-coral' : 'border-ink/25'"
                >
                <span v-if="form.errors.email" class="text-xs font-normal text-ink">{{ form.errors.email }}</span>
            </label>
        </div>

        <label class="mt-5 grid gap-2 text-sm font-bold text-ink">
            Mensaje
            <textarea
                v-model="form.message"
                name="message"
                rows="4"
                placeholder="Cuéntame brevemente qué estás construyendo..."
                class="resize-y border bg-transparent px-4 py-4 text-sm font-normal leading-6 outline-none transition placeholder:text-ink/40 focus:border-ink"
                :class="form.errors.message ? 'border-coral' : 'border-ink/25'"
            ></textarea>
            <span v-if="form.errors.message" class="text-xs font-normal text-ink">{{ form.errors.message }}</span>
        </label>

        <label class="absolute left-[-9999px]" aria-hidden="true">
            Website
            <input v-model="form.website" type="text" name="website" tabindex="-1" autocomplete="off">
        </label>

        <div class="mt-5 flex items-center justify-between gap-4">
            <p class="max-w-xs text-xs leading-5 text-ink/55">Tus datos solo se usan para responder a este mensaje.</p>
            <button
                type="submit"
                class="inline-flex items-center gap-5 bg-ink px-5 py-4 font-mono text-xs uppercase tracking-[.05em] text-paper transition hover:bg-ink-soft disabled:cursor-wait disabled:opacity-60"
                :disabled="form.processing"
            >
                {{ form.processing ? 'Enviando...' : 'Enviar mensaje' }}
                <span aria-hidden="true">↗</span>
            </button>
        </div>
    </form>
</template>
