<?php

namespace App\Http\Controllers;

use App\Repositories\LeverancierRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeverancierController extends Controller
{
    public function __construct(private LeverancierRepository $leveranciers) {}

    public function index(): View
    {
        $leveranciers = $this->leveranciers->getLeveranciers();

        return view('leveranciers.index', compact('leveranciers'));
    }

    public function producten(int $leverancierId): View
    {
        $leverancier = $this->leveranciers->getLeverancier($leverancierId);

        if (! $leverancier) {
            abort(404);
        }

        $producten = $this->leveranciers->getGeleverdeProducten($leverancierId);

        return view('leveranciers.producten', compact('leverancier', 'producten'));
    }

    public function createLevering(int $leverancierId, int $productId): View
    {
        $leverancier = $this->leveranciers->getLeverancierProduct($leverancierId, $productId);

        if (! $leverancier) {
            abort(404);
        }

        return view('leveranciers.levering', compact('leverancier'));
    }

    public function storeLevering(Request $request, int $leverancierId, int $productId): RedirectResponse
    {
        $leverancier = $this->leveranciers->getLeverancierProduct($leverancierId, $productId);

        if (! $leverancier) {
            abort(404);
        }

        $validated = $request->validate([
            'aantal' => ['required', 'integer', 'min:1', 'max:2147483647'],
            'datum_eerst_volgende_levering' => ['required', 'date_format:Y-m-d'],
        ]);

        $isOpgeslagen = $this->leveranciers->voegLeveringToe(
            $leverancierId,
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
