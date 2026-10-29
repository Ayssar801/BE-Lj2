<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Levering product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="mb-6 space-y-2 text-gray-700">
                    <p><span class="font-semibold">Product:</span> {{ $leverancier->ProductNaam }}</p>
                    <p><span class="font-semibold">Leverancier:</span> {{ $leverancier->LeverancierNaam }}</p>
                    <p><span class="font-semibold">Contactpersoon:</span> {{ $leverancier->ContactPersoon }}</p>
                    <p><span class="font-semibold">Mobiel:</span> {{ $leverancier->Mobiel }}</p>
                </div>

                @if (session('error'))
                    <div role="alert" class="mb-5 rounded-md bg-red-50 p-4 text-red-800">
                        {{ session('error') }}
                    </div>
                    <script>
                        window.setTimeout(() => {
                            window.location.href = @json(route('leveranciers.producten', $leverancier->LeverancierId));
                        }, 4000);
                    </script>
                @endif

                <form method="POST" action="{{ route('leveranciers.levering.store', [$leverancier->LeverancierId, $leverancier->ProductId]) }}" class="space-y-5">
                    @csrf

                    <div class="flex flex-wrap items-center gap-4">
                        <label for="aantal" class="text-sm font-medium text-gray-700">Aantal producteenheden</label>
                        <input id="aantal" name="aantal" type="number" min="1" step="1" required
                               value="{{ old('aantal') }}"
                               class="block w-44 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('aantal')
                            <p class="w-full text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap items-center gap-4">
                        <label for="datum_eerst_volgende_levering" class="text-sm font-medium text-gray-700">Datum eerstvolgende levering</label>
                        <input id="datum_eerst_volgende_levering" name="datum_eerst_volgende_levering" type="date" required
                               value="{{ old('datum_eerst_volgende_levering') }}"
                               class="block w-44 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('datum_eerst_volgende_levering')
                            <p class="w-full text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap justify-between gap-3 pt-2">
                        <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                            Sla op
                        </button>
                        <div class="flex gap-3">
                            <a href="{{ route('leveranciers.producten', $leverancier->LeverancierId) }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Terug
                            </a>
                            <a href="{{ route('dashboard') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Home
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
