<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class MagazijnTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed', ['--class' => 'JaminSeeder']);
    }

    public function test_overzicht_magazijn_jamin_accessible()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('magazijn.index'));

        $response->assertStatus(200);
        $response->assertSee('Overzicht Magazijn Jamin');
        $response->assertSee('Mintnopjes');
        $response->assertSee('8719587231278');
    }

    public function test_user_story_01_scenario_01_levering_info_mintnopjes()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('leverantie.show', ['productId' => 1]));

        $response->assertStatus(200);
        $response->assertSee('Levering Informatie');
        $response->assertSee('Venco');
        $response->assertSee('Bert van Linge');
        $response->assertSee('L1029384719');
        $response->assertSee('06-28493827');
        $response->assertSee('09-10-2024');
        $response->assertSee('18-10-2024');
    }

    public function test_user_story_01_scenario_02_levering_info_winegums_geen_voorraad()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('leverantie.show', ['productId' => 10]));

        $response->assertStatus(200);
        $response->assertSee('Naam Leverancier:');
        $response->assertSee('Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is: 30-04-2023');
        $response->assertSee('setTimeout');
    }

    public function test_user_story_02_scenario_01_allergenen_info_zoute_ruitjes()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('allergenen.show', ['productId' => 13]));

        $response->assertStatus(200);
        $response->assertSee('Overzicht Allergenen');
        $response->assertSee('Zoute Ruitjes');
        $response->assertSee('8719587323256');
        $response->assertSee('Gluten');
        $response->assertSee('Lactose');
        $response->assertSee('Soja');
    }

    public function test_user_story_02_scenario_02_allergenen_info_cola_flesjes_geen_allergenen()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('allergenen.show', ['productId' => 5]));

        $response->assertStatus(200);
        $response->assertSee('In dit product zitten geen stoffen die een allergische reactie kunnen veroorzaken');
        $response->assertSee('setTimeout');
    }
}
