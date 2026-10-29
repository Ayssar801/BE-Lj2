<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateAdminUser extends Command
{
    protected $signature = 'user:create-admin {name : Naam van de beheerder} {email : E-mailadres van de beheerder}';

    protected $description = 'Maak een beheerder-account aan met een lokaal ingevoerd wachtwoord';

    public function handle(): int
    {
        $validator = Validator::make([
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $password = $this->secret('Kies een wachtwoord');

        if (! is_string($password) || $password === '') {
            $this->error('Het wachtwoord mag niet leeg zijn.');

            return self::FAILURE;
        }

        $passwordValidator = Validator::make(['password' => $password], [
            'password' => ['required', Password::defaults()],
        ]);

        if ($passwordValidator->fails()) {
            foreach ($passwordValidator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $confirmation = $this->secret('Bevestig het wachtwoord');

        if ($confirmation !== $password) {
            $this->error('De wachtwoorden komen niet overeen.');

            return self::FAILURE;
        }

        $user = User::query()->create([
            'name' => $this->argument('name'),
            'email' => strtolower($this->argument('email')),
            'password' => Hash::make($password),
            'role' => UserRole::Beheerder,
        ]);

        $this->info("Beheerder-account aangemaakt voor {$user->email}.");

        return self::SUCCESS;
    }
}
