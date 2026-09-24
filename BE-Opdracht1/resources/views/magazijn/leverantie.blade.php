<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Levering Informatie
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="mb-6 space-y-1 text-gray-800">
                    <p><span class="font-bold">Naam Leverancier:</span> {{ $leverancierInfo->Naam }}</p>
                    <p><span class="font-bold">Contactpersoon leverancier:</span> {{ $leverancierInfo->ContactPersoon }}</p>
                    <p><span class="font-bold">Leveranciernummer:</span> {{ $leverancierInfo->LeverancierNummer }}</p>
                    <p><span class="font-bold">Mobiel:</span> {{ $leverancierInfo->Mobiel }}</p>
                </div>

                @if ($heeftGeenVoorraad)
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Naam Product</th>
                                <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Datum laatste levering</th>
                                <th class="border border-gray-300 px-4 py-2 text-right font-semibold">Aantal</th>
                                <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Eerstvolgende levering</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="border border-gray-300 px-4 py-4 text-center text-red-600 font-medium">
                                    Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is: {{ $eerstVolgendeDatum }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <script>
                        setTimeout(function () {
                            window.location.href = "{{ route('magazijn.index') }}";
                        }, 4000);
                    </script>
                @else
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Naam Product</th>
                                <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Datum laatste levering</th>
                                <th class="border border-gray-300 px-4 py-2 text-right font-semibold">Aantal</th>
                                <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Eerstvolgende levering</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leveringen as $levering)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2">{{ $levering->ProductName }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ date('d-m-Y', strtotime($levering->DatumLevering)) }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right">{{ $levering->Aantal }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $levering->DatumEerstVolgendeLevering ? date('d-m-Y', strtotime($levering->DatumEerstVolgendeLevering)) : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="border border-gray-300 px-4 py-4 text-center text-gray-600">
                                        Er zijn geen leveringen gevonden.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>