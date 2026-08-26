<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(
            [
                'name' => ['required', 'string', 'max:120'],
                'email' => ['required', 'email', 'max:160'],
                'message' => ['required', 'string', 'min:20', 'max:3000'],
                'website' => ['nullable', 'max:0'],
            ],
            [
                'name.required' => 'Escribe tu nombre.',
                'name.max' => 'El nombre no puede superar los 120 caracteres.',
                'email.required' => 'Escribe tu email.',
                'email.email' => 'Escribe un email válido.',
                'email.max' => 'El email no puede superar los 160 caracteres.',
                'message.required' => 'Escribe un mensaje.',
                'message.min' => 'El mensaje debe tener al menos 20 caracteres.',
                'message.max' => 'El mensaje no puede superar los 3000 caracteres.',
                'website.max' => 'No se pudo procesar la solicitud.',
            ],
        );

        Mail::raw(
            "Nombre: {$data['name']}\nEmail: {$data['email']}\n\n{$data['message']}",
            function ($mail) use ($data): void {
                $mail
                    ->to(config('contact.recipient'))
                    ->replyTo($data['email'], $data['name'])
                    ->subject('Nuevo mensaje desde tu presentación web');
            },
        );

        return back()->with('success', 'Mensaje enviado correctamente.');
    }
}
