<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolesTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_allows_customer_and_magazijnmedewerker_roles(): void
    {
        foreach ([
            'medewerker@example.com' => UserRole::Magazijnmedewerker,
            'klant@example.com' => UserRole::Klant,
        ] as $email => $role) {
            $response = $this->post(route('register'), [
                'name' => 'Nieuwe Gebruiker',
                'email' => $email,
                'password' => 'Password123!',
                'password_confirmation' => 'Password123!',
                'role' => $role->value,
            ]);

            $response->assertRedirect(route('dashboard'));
            $this->assertDatabaseHas('users', [
                'email' => $email,
                'role' => $role->value,
            ]);

            auth()->logout();
        }
    }

    public function test_registration_cannot_create_a_beheerder(): void
    {
        $this->post(route('register'), [
            'name' => 'Ongeautoriseerde Beheerder',
            'email' => 'beheerder@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => UserRole::Beheerder->value,
        ])->assertSessionHasErrors('role');

        $this->assertDatabaseMissing('users', [
            'email' => 'beheerder@example.com',
        ]);
    }

    public function test_magazijnmedewerker_can_view_magazijn_but_not_manage_users(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('magazijn.index'))->assertOk();
        $this->actingAs($user)->get(route('users.index'))->assertForbidden();
        $this->actingAs($user)->patch(route('users.role.update', $user), [
            'role' => UserRole::Beheerder->value,
        ])->assertForbidden();
    }

    public function test_klant_can_only_view_dashboard_and_not_magazijn_pages(): void
    {
        $klant = User::factory()->create(['role' => UserRole::Klant]);

        $this->actingAs($klant)->get(route('dashboard'))->assertOk();
        $this->actingAs($klant)->get(route('magazijn.index'))->assertForbidden();
        $this->actingAs($klant)->get(route('leverantie.show', 1))->assertForbidden();
        $this->actingAs($klant)->get(route('allergenen.show', 1))->assertForbidden();
    }

    public function test_beheerder_can_change_a_users_role(): void
    {
        $beheerder = User::factory()->create(['role' => UserRole::Beheerder]);
        $medewerker = User::factory()->create();

        $this->actingAs($beheerder)->get(route('users.index'))->assertOk();

        $this->actingAs($beheerder)
            ->patch(route('users.role.update', $medewerker), [
                'role' => UserRole::Beheerder->value,
            ])
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'id' => $medewerker->id,
            'role' => UserRole::Beheerder->value,
        ]);
    }

    public function test_user_make_admin_command_promotes_an_existing_user(): void
    {
        $user = User::factory()->create();

        $this->artisan('user:make-admin', ['email' => $user->email])
            ->expectsOutput("{$user->email} is nu beheerder.")
            ->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'role' => UserRole::Beheerder->value,
        ]);
    }

    public function test_user_create_admin_command_creates_account_with_entered_password(): void
    {
        $this->artisan('user:create-admin', [
            'name' => 'Eerste Beheerder',
            'email' => 'admin@example.com',
        ])
            ->expectsQuestion('Kies een wachtwoord', 'Password123!')
            ->expectsQuestion('Bevestig het wachtwoord', 'Password123!')
            ->expectsOutput('Beheerder-account aangemaakt voor admin@example.com.')
            ->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'name' => 'Eerste Beheerder',
            'email' => 'admin@example.com',
            'role' => UserRole::Beheerder->value,
        ]);

        $this->assertTrue(
            \Illuminate\Support\Facades\Hash::check(
                'Password123!',
                User::query()->where('email', 'admin@example.com')->firstOrFail()->password,
            ),
        );
    }

    public function test_last_beheerder_cannot_be_downgraded(): void
    {
        $beheerder = User::factory()->create(['role' => UserRole::Beheerder]);

        $this->actingAs($beheerder)
            ->patch(route('users.role.update', $beheerder), [
                'role' => UserRole::Magazijnmedewerker->value,
            ])
            ->assertSessionHasErrors('role');

        $this->assertDatabaseHas('users', [
            'id' => $beheerder->id,
            'role' => UserRole::Beheerder->value,
        ]);
    }
}
