<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Console\Command;

class MakeUserAdmin extends Command
{
    protected $signature = 'user:make-admin {email : Het e-mailadres van de bestaande gebruiker}';

    protected $description = 'Geef een bestaande gebruiker de rol beheerder';

    public function handle(): int
    {
        $user = User::query()->where('email', $this->argument('email'))->first();

        if ($user === null) {
            $this->error('Er bestaat geen gebruiker met dit e-mailadres.');

            return self::FAILURE;
        }

        $user->role = UserRole::Beheerder;
        $user->save();

        $this->info("{$user->email} is nu beheerder.");

        return self::SUCCESS;
    }
}
