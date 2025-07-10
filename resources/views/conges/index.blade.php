@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">

    {{-- Titre --}}
    <h2 class="text-2xl font-bold text-gray-800 mb-4">📝 Liste des demandes de congé</h2>

    {{-- Tableau --}}
    <div class="bg-white rounded shadow p-6">
        @if($conges->isEmpty())
            <p class="text-gray-500">Aucune demande de congé enregistrée.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-sm divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2 text-left">Employé</th>
                            <th class="px-4 py-2 text-left">Date début</th>
                            <th class="px-4 py-2 text-left">Date fin</th>
                            <th class="px-4 py-2 text-left">Statut</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($conges as $conge)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 font-medium text-gray-800">{{ $conge->employe->user->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">
                                @if($conge->status === 'en_attente')
                                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">En attente</span>
                                @elseif($conge->status === 'approuve')
                                    <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Approuvé</span>
                                @else
                                    <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">Rejeté</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if($conge->status === 'en_attente')
                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('conges.updateStatut', $conge->id) }}">
                                            @csrf
                                            <input type="hidden" name="statut" value="approuve">
                                            <button class="bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-1 rounded">✅ Approuver</button>
                                        </form>
                                        <form method="POST" action="{{ route('conges.updateStatut', $conge->id) }}">
                                            @csrf
                                            <input type="hidden" name="statut" value="rejete">
                                            <button class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded">❌ Rejeter</button>
                                        </form>
                                    </div>
                                @else
                                    <em class="text-gray-500 text-xs">Aucune action</em>
                                @endif
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
