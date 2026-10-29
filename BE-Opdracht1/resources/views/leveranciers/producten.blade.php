<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Geleverde producten
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="mb-6 space-y-1 text-gray-700">
                    <p><span class="font-semibold">Naam leverancier:</span> {{ $leverancier->Naam }}</p>
                    <p><span class="font-semibold">Contactpersoon:</span> {{ $leverancier->ContactPersoon }}</p>
                    <p><span class="font-semibold">Leveranciersnummer:</span> {{ $leverancier->LeverancierNummer }}</p>
                    <p><span class="font-semibold">Mobiel:</span> {{ $leverancier->Mobiel }}</p>
                </div>

                @if (session('success'))
                    <div role="status" class="mb-5 rounded-md bg-green-50 p-4 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-3 text-center font-semibold">Naam product</th>
                                <th class="border border-gray-300 px-4 py-3 text-center font-semibold">Aantal in magazijn</th>
                                <th class="border border-gray-300 px-4 py-3 text-center font-semibold">Verpakkingseenheid</th>
                                <th class="border border-gray-300 px-4 py-3 text-center font-semibold">Laatste levering</th>
                                <th class="border border-gray-300 px-4 py-3 text-center font-semibold">Nieuwe levering</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($producten as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-3 text-center">{{ $product->Naam }}</td>
                                    <td class="border border-gray-300 px-4 py-3 text-center">{{ $product->AantalAanwezig ?? 'Geen voorraad' }}</td>
                                    <td class="border border-gray-300 px-4 py-3 text-center">{{ $product->VerpakkingsEenheidInKilogram ?? 'Onbekend' }} kg</td>
                                    <td class="border border-gray-300 px-4 py-3 text-center">
                                        {{ $product->LaatsteLevering ? \Carbon\Carbon::parse($product->LaatsteLevering)->format('d-m-Y') : 'Geen levering bekend' }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-3 text-center">
                                        <a href="{{ route('leveranciers.levering.create', [$leverancier->LeverancierId, $product->ProductId]) }}"
                                           title="Nieuwe levering van {{ $product->Naam }}"
                                           aria-label="Nieuwe levering van {{ $product->Naam }}"
                                           class="inline-flex items-center justify-center px-2 py-1 text-xl font-bold text-black hover:text-gray-700">
                                            +
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border border-gray-300 px-4 py-3 text-center">
                                        Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (empty($producten))
                    <script>
                        window.setTimeout(() => {
                            window.location.href = @json(route('leveranciers.index'));
                        }, 3000);
                    </script>
                @endif

                <div class="mt-6 flex justify-end gap-3">
                    <a href="{{ route('leveranciers.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Terug
                    </a>
                    <a href="{{ route('dashboard') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                        Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
