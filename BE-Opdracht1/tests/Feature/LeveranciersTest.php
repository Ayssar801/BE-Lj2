<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LeveranciersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed', ['--class' => 'JaminSeeder']);
    }

    public function test_leveranciers_overzicht_is_gesorteerd_op_aantal_unieke_producten(): void
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('leveranciers.index'));

        $response->assertOk()
            ->assertSee('Overzicht leveranciers')
            ->assertSee('Quality Street')
            ->assertSeeInOrder(['Astra Sweets', 'De Bron', 'Haribo', 'Venco', 'Basset', 'Quality Street']);
    }

    public function test_leverancier_detail_toont_unieke_producten_voorraad_en_laatste_levering(): void
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('leveranciers.producten', 1));

        $response->assertOk()
            ->assertSee('Geleverde producten')
            ->assertSee('Venco')
            ->assertSee('Mintnopjes')
            ->assertSee('Schoolkrijt')
            ->assertSee('453')
            ->assertSee('Verpakkingseenheid')
            ->assertSee('5 kg')
            ->assertSee('18-11-2024');
    }

    public function test_levering_formulier_plaatst_invoervelden_naast_de_labels(): void
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('leveranciers.levering.create', [1, 1]));

        $response->assertOk()
            ->assertSee('class="flex flex-wrap items-center gap-4"', false)
            ->assertSee('id="aantal"', false)
            ->assertSee('id="datum_eerst_volgende_levering"', false)
            ->assertSee('class="block w-44 rounded-md', false);
    }

    public function test_leverancier_zonder_leveringen_ziet_melding_en_wordt_teruggestuurd(): void
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('leveranciers.producten', 6));

        $response->assertOk()
            ->assertSee('Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin.')
            ->assertSee('Naam product')
            ->assertSee('Aantal in magazijn')
            ->assertSee('Verpakkingseenheid')
            ->assertSee('Laatste levering')
            ->assertSee('Nieuwe levering')
            ->assertSee('colspan="5"', false)
            ->assertSee('3000');
    }

    public function test_nieuwe_levering_verhoogt_voorraad_en_werkt_laatste_levering_bij(): void
    {
        $response = $this->actingAs(User::factory()->create())
            ->post(route('leveranciers.levering.store', [1, 1]), [
                'aantal' => 25,
                'datum_eerst_volgende_levering' => '2024-05-29',
            ]);

        $response->assertRedirect(route('leveranciers.producten', 1));

        $this->assertSame(
            478,
            (int) DB::table('magazijnen')->where('ProductId', 1)->value('AantalAanwezig')
        );
        $this->assertDatabaseHas('product_per_leveranciers', [
            'LeverancierId' => 1,
            'ProductId' => 1,
            'DatumLevering' => now()->toDateString(),
            'Aantal' => 25,
            'DatumEerstVolgendeLevering' => '2024-05-29',
        ]);

        $this->get(route('leveranciers.producten', 1))
            ->assertSee(now()->format('d-m-Y'))
            ->assertSee('De levering van Mintnopjes is opgeslagen.');
    }

    public function test_inactief_product_wordt_niet_opgeslagen_en_toont_melding(): void
    {
        $response = $this->actingAs(User::factory()->create())
            ->post(route('leveranciers.levering.store', [4, 10]), [
                'aantal' => 30,
                'datum_eerst_volgende_levering' => now()->toDateString(),
            ]);

        $response->assertRedirect(route('leveranciers.levering.create', [4, 10]))
            ->assertSessionHas(
                'error',
                'Het product Winegums van de leverancier Basset wordt niet meer geproduceerd.'
            )
            ->assertSessionHasInput('aantal', 30)
            ->assertSessionHasInput('datum_eerst_volgende_levering', now()->toDateString());

        $this->assertSame(
            1,
            DB::table('product_per_leveranciers')->where('LeverancierId', 4)->where('ProductId', 10)->count()
        );

        $this->get(route('leveranciers.levering.create', [4, 10]))
            ->assertSee('Het product Winegums van de leverancier Basset wordt niet meer geproduceerd.')
            ->assertSee('value="30"', false)
            ->assertSee('value="'.now()->toDateString().'"', false)
            ->assertSee('4000');
    }
}
