@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">

    {{-- Titre --}}
    <h2 class="text-2xl font-bold text-gray-800">👨‍💼 Tableau de bord Manager</h2>

    {{-- Message de bienvenue --}}
    <div class="bg-white p-4 rounded shadow text-gray-700">
        <p>Bienvenue, <span class="font-semibold">{{ Auth::user()->name }}</span>. Voici les membres de votre équipe et leurs demandes de congé.</p>
    </div>

    {{-- Équipe --}}
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">👥 Équipe actuelle</h3>

        @if($equipe->isEmpty())
            <p class="text-gray-500">Aucun membre dans votre équipe.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Poste</th>
                            <th class="px-4 py-2">Département</th>
                            <th class="px-4 py-2">Raison</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($equipe as $employe)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $employe->user->name }}</td>
                                <td class="px-4 py-2">{{ $employe->poste }}</td>
                                <td class="px-4 py-2">{{ $employe->departement->name ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $employe->type_conge }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Liens utiles --}}
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">📄 Gestion des congés</h3>
        <a href="{{ route('conges.index') }}" class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
            Voir les demandes de congé
        </a>
    </div>

</div>
@endsection
