<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gebruikers en rollen beheren
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('status'))
                        <p class="mb-4 text-sm text-green-700">{{ session('status') }}</p>
                    @endif

                    @error('role')
                        <p class="mb-4 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Naam</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">E-mailadres</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Rol beheren</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-4 py-3">{{ $user->name }}</td>
                                        <td class="px-4 py-3">{{ $user->email }}</td>
                                        <td class="px-4 py-3">
                                            <form method="POST" action="{{ route('users.role.update', $user) }}" class="flex items-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <label class="sr-only" for="role-{{ $user->id }}">Rol voor {{ $user->name }}</label>
                                                <select id="role-{{ $user->id }}" name="role" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->value }}" @selected($user->role === $role)>
                                                            {{ $role->label() }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">
                                                    Opslaan
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
