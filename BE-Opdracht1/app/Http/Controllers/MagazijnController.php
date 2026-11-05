<?php

namespace App\Http\Controllers;

use App\Models\Product;

class MagazijnController extends Controller
{
    // Haalt product- en voorraadgegevens op voor het magazijnoverzicht.
    public function index()
    {
        $producten = Product::query()
            ->with('magazijn')
            ->orderBy('Barcode', 'asc')
            ->get();

        return view('magazijn.index', compact('producten'));
    }

    // Toont de leverancier, voorraad en leveringshistorie van één product.
    public function leverantie($productId)
    {
        $product = Product::query()
            ->with('magazijn')
            ->find($productId);

        if (! $product) {
            abort(404);
        }

        $aantalAanwezig = $product->magazijn?->AantalAanwezig;
        $heeftGeenVoorraad = $aantalAanwezig === null || $aantalAanwezig === 0;

        $leverancier = $product->leveranciers()
            ->select(
                'leveranciers.Naam',
                'leveranciers.ContactPersoon',
                'leveranciers.LeverancierNummer',
                'leveranciers.Mobiel'
            )
            ->first();

        $leverancierInfo = $leverancier ?? (object) [
            'Naam' => '-',
            'ContactPersoon' => '-',
            'LeverancierNummer' => '-',
            'Mobiel' => '-',
        ];

        $leveringen = $product->leveringen()
            ->with('product')
            ->orderBy('DatumLevering', 'asc')
            ->get();

        $eerstVolgendeDatum = null;
        if ($heeftGeenVoorraad) {
            $eerstVolgendeRaw = $product->leveringen()
                ->whereNotNull('DatumEerstVolgendeLevering')
                ->orderByDesc('DatumLevering')
                ->value('DatumEerstVolgendeLevering');

            if ($eerstVolgendeRaw) {
                $eerstVolgendeDatum = date('d-m-Y', strtotime($eerstVolgendeRaw));
            } else {
                $eerstVolgendeDatum = 'Onbekend';
            }
        }

        return view('magazijn.leverantie', compact(
            'product',
            'heeftGeenVoorraad',
            'leverancierInfo',
            'leveringen',
            'eerstVolgendeDatum'
        ));
    }

    // Zoekt een product en toont de allergenen die eraan gekoppeld zijn.
    public function allergenen($productId)
    {
        $product = Product::query()->find($productId);

        if (! $product) {
            abort(404);
        }

        $allergenen = $product->allergenen()
            ->orderBy('Naam', 'asc')
            ->get();

        return view('magazijn.allergenen', compact('product', 'allergenen'));
    }
}
