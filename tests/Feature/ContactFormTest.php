<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function test_the_contact_form_validates_required_fields(): void
    {
        $response = $this->from('/')->post('/contact', [
            'name' => '',
            'email' => 'not-an-email',
            'message' => 'short',
        ]);

        $response
            ->assertRedirect('/')
            ->assertSessionHasErrors(['name', 'email', 'message']);
    }

    public function test_the_contact_form_accepts_a_valid_message(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Persona interesada',
            'email' => 'persona@example.com',
            'message' => 'Me gustaría conversar sobre una oportunidad profesional.',
        ]);

        $response
            ->assertRedirect('/')
            ->assertSessionHas('success', 'Mensaje enviado correctamente.');
    }
}
