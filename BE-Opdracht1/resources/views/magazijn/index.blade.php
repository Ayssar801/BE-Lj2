<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Overzicht Magazijn Jamin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Barcode</th>
                            <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Naam</th>
                            <th class="border border-gray-300 px-4 py-2 text-right font-semibold">Verpakkingseenheid (kg)</th>
                            <th class="border border-gray-300 px-4 py-2 text-right font-semibold">Aantal aanwezig</th>
                            <th class="border border-gray-300 px-4 py-2 text-center font-semibold">Allergenen Info</th>
                            <th class="border border-gray-300 px-4 py-2 text-center font-semibold">Leverantie Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($producten as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $product->Barcode }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $product->Naam }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-right">{{ $product->VerpakkingsEenheidInKilogram }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-right">{{ $product->AantalAanwezig ?? 'Geen voorraad' }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <a href="{{ route('allergenen.show', ['productId' => $product->product_id]) }}"
                                       title="Allergeneninformatie" class="text-red-600 hover:text-red-800 font-bold text-xl inline-block px-2 py-1">❌</a>
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <a href="{{ route('leverantie.show', ['productId' => $product->product_id]) }}"
                                       title="Leverantie informatie" class="text-blue-600 hover:text-blue-800 font-bold text-xl inline-block px-2 py-1">?</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>