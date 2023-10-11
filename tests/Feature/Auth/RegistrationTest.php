<?php

use App\Enums\UserTypesEnum;
use App\Providers\RouteServiceProvider;
use Faker\Factory;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $faker = Factory::create('pt_BR');
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'type_id' => fake()->randomElement([UserTypesEnum::COLLABORATOR->value, UserTypesEnum::CLIENT->value]),
        'cpf' => $faker->cpf(false)
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
