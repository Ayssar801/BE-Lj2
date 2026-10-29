<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Overzicht leveranciers
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="mb-6 flex items-center justify-between">
                    <p class="text-gray-700">Leveranciers en het aantal verschillende producten dat zij aan Jamin leveren.</p>
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-indigo-700 hover:text-indigo-900">
                        Home
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-3 text-left font-semibold">Naam</th>
                                <th class="border border-gray-300 px-4 py-3 text-left font-semibold">Contactpersoon</th>
                                <th class="border border-gray-300 px-4 py-3 text-center font-semibold">Leveranciersnummer</th>
                                <th class="border border-gray-300 px-4 py-3 text-center font-semibold">Mobiel</th>
                                <th class="border border-gray-300 px-4 py-3 text-center font-semibold">Aantal verschillende producten</th>
                                <th class="border border-gray-300 px-4 py-3 text-center font-semibold">Toon producten</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leveranciers as $leverancier)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-3 text-left">{{ $leverancier->Naam }}</td>
                                    <td class="border border-gray-300 px-4 py-3 text-left">{{ $leverancier->ContactPersoon }}</td>
                                    <td class="border border-gray-300 px-4 py-3 text-center">{{ $leverancier->LeverancierNummer }}</td>
                                    <td class="border border-gray-300 px-4 py-3 text-center">{{ $leverancier->Mobiel }}</td>
                                    <td class="border border-gray-300 px-4 py-3 text-center">{{ $leverancier->AantalVerschillendeProducten }}</td>
                                    <td class="border border-gray-300 px-4 py-3 text-center">
                                        <a href="{{ route('leveranciers.producten', $leverancier->LeverancierId) }}"
                                           title="Geleverde producten van {{ $leverancier->Naam }}"
                                           aria-label="Toon producten van {{ $leverancier->Naam }}"
                                           class="inline-flex items-center justify-center rounded px-2 py-1 text-black hover:bg-gray-100">
                                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" d="M3 7.3 12 4l9 3.3v9.4L12 20l-9-3.3V7.3Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.9" d="M3 7.3 12 11l9-3.7M12 11v9M7.5 5.7 16.8 9" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border border-gray-300 px-4 py-6 text-center text-gray-600">
                                        Er zijn geen actieve leveranciers gevonden.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
