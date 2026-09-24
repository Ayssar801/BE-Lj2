<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Overzicht Allergenen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="mb-6 space-y-1 text-gray-800">
                    <p><span class="font-bold">Naam:</span> {{ $product->Naam }}</p>
                    <p><span class="font-bold">Barcode:</span> {{ $product->Barcode }}</p>
                </div>

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Naam</th>
                            <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Omschrijving</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($allergenen->isEmpty())
                            <tr>
                                <td colspan="2" class="border border-gray-300 px-4 py-4 text-center text-gray-700 italic font-medium">
                                    In dit product zitten geen stoffen die een allergische reactie kunnen veroorzaken
                                </td>
                            </tr>
                        @else
                            @foreach ($allergenen as $allergeen)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2">{{ $allergeen->Naam }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $allergeen->Omschrijving }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                @if ($allergenen->isEmpty())
                    <script>
                        setTimeout(function () {
                            window.location.href = "{{ route('magazijn.index') }}";
                        }, 4000);
                    </script>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>