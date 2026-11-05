<?php

namespace App\Http\Controllers;

use App\Models\Leverancier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeverancierController extends Controller
{
    // Toont het overzicht met leveranciers.
    public function index(): View
    {
        $leveranciers = Leverancier::overzicht();

        return view('leveranciers.index', compact('leveranciers'));
    }

    // Toont de gegevens en producten van de gekozen leverancier.
    public function producten(int $leverancierId): View
    {
        $leverancier = Leverancier::query()
            ->where('IsActief', true)
            ->find($leverancierId);

        if (! $leverancier) {
            abort(404);
        }

        $producten = $leverancier->geleverdeProducten();

        return view('leveranciers.producten', compact('leverancier', 'producten'));
    }

    // Controleert de leverancier/productcombinatie en toont het leveringsformulier.
    public function createLevering(int $leverancierId, int $productId): View
    {
        $leverancierModel = Leverancier::query()->find($leverancierId);
        $leverancier = $leverancierModel?->productVoorLevering($productId);

        if (! $leverancier) {
            abort(404);
        }

        return view('leveranciers.levering', compact('leverancier'));
    }

    // Valideert het formulier en laat het model de levering opslaan.
    public function storeLevering(Request $request, int $leverancierId, int $productId): RedirectResponse
    {
        $leverancierModel = Leverancier::query()->find($leverancierId);
        $leverancier = $leverancierModel?->productVoorLevering($productId);

        if (! $leverancier) {
            abort(404);
        }

        $validated = $request->validate([
            'aantal' => ['required', 'integer', 'min:1', 'max:2147483647'],
            'datum_eerst_volgende_levering' => ['required', 'date_format:Y-m-d'],
        ]);

        $isOpgeslagen = $leverancierModel->voegLeveringToe(
            $productId,
            (int) $validated['aantal'],
            $validated['datum_eerst_volgende_levering']
        );

        if (! $isOpgeslagen) {
            return redirect()
                ->route('leveranciers.levering.create', [$leverancierId, $productId])
                ->withInput($request->only('aantal', 'datum_eerst_volgende_levering'))
                ->with('error', "Het product {$leverancier->ProductNaam} van de leverancier {$leverancier->LeverancierNaam} wordt niet meer geproduceerd.");
        }

        return redirect()
            ->route('leveranciers.producten', $leverancierId)
            ->with('success', "De levering van {$leverancier->ProductNaam} is opgeslagen.");
    }
}
