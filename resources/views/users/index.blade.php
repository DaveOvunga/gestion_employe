@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">

    {{-- Titre --}}
    <h2 class="text-2xl font-bold text-gray-800">👥 Liste des utilisateurs</h2>

    {{-- Tableau --}}
    <div class="bg-white p-6 rounded shadow">
        @if($users->isEmpty())
            <p class="text-gray-500">Aucun utilisateur trouvé.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2 text-left">Nom</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Rôle</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 font-medium text-gray-800">{{ $user->name }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ $user->email }}</td>
                                <td class="px-4 py-2">
                                    @foreach($user->roles as $role)
                                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
