<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MagazijnController extends Controller
{
    public function index()
    {
        $producten = DB::table('producten')
            ->leftJoin(
                'magazijnen',
                'producten.ProductId',
                '=',
                'magazijnen.ProductId'
            )
            ->select(
                'producten.ProductId as product_id',
                'producten.Naam',
                'producten.Barcode',
                'magazijnen.VerpakkingsEenheidInKilogram',
                'magazijnen.AantalAanwezig'
            )
            ->orderBy('producten.Barcode', 'asc')
            ->get();

        return view('magazijn.index', compact('producten'));
    }

    public function leverantie($productId)
    {
        $product = DB::table('producten')
            ->leftJoin('magazijnen', 'producten.ProductId', '=', 'magazijnen.ProductId')
            ->where('producten.ProductId', $productId)
            ->select(
                'producten.ProductId',
                'producten.Naam as ProductName',
                'magazijnen.AantalAanwezig'
            )
            ->first();

        if (!$product) {
            abort(404);
        }

        $heeftGeenVoorraad = is_null($product->AantalAanwezig) || $product->AantalAanwezig == 0;

        $leverancier = DB::table('product_per_leveranciers')
            ->join('leveranciers', 'product_per_leveranciers.LeverancierId', '=', 'leveranciers.LeverancierId')
            ->where('product_per_leveranciers.ProductId', $productId)
            ->select(
                'leveranciers.Naam',
                'leveranciers.ContactPersoon',
                'leveranciers.LeverancierNummer',
                'leveranciers.Mobiel'
            )
            ->first();

        $leverancierInfo = $leverancier ?? (object)[
            'Naam' => '-',
            'ContactPersoon' => '-',
            'LeverancierNummer' => '-',
            'Mobiel' => '-'
        ];

        $leveringen = DB::table('product_per_leveranciers')
            ->join('producten', 'product_per_leveranciers.ProductId', '=', 'producten.ProductId')
            ->where('product_per_leveranciers.ProductId', $productId)
            ->select(
                'producten.Naam as ProductName',
                'product_per_leveranciers.DatumLevering',
                'product_per_leveranciers.Aantal',
                'product_per_leveranciers.DatumEerstVolgendeLevering'
            )
            ->orderBy('product_per_leveranciers.DatumLevering', 'asc')
            ->get();

        $eerstVolgendeDatum = null;
        if ($heeftGeenVoorraad) {
            $eerstVolgendeRaw = DB::table('product_per_leveranciers')
                ->where('ProductId', $productId)
                ->whereNotNull('DatumEerstVolgendeLevering')
                ->orderBy('DatumLevering', 'desc')
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

    public function allergenen($productId)
    {
        $product = DB::table('producten')
            ->where('ProductId', $productId)
            ->first();

        if (!$product) {
            abort(404);
        }

        $allergenen = DB::table('product_per_allergenen')
            ->join(
                'allergenen',
                'product_per_allergenen.AllergeenId',
                '=',
                'allergenen.AllergeenId'
            )
            ->where('product_per_allergenen.ProductId', $productId)
            ->select('allergenen.Naam', 'allergenen.Omschrijving')
            ->orderBy('allergenen.Naam', 'asc')
            ->get();

        return view('magazijn.allergenen', compact('product', 'allergenen'));
    }
} 