@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">

    {{-- Titre --}}
    <h2 class="text-2xl font-bold text-gray-800 mb-4">🧑‍💼 Liste des employés</h2>

    {{-- Tableau stylisé --}}
    <div class="bg-white p-6 rounded shadow">
        @if($employes->isEmpty())
            <p class="text-gray-500">Aucun employé trouvé.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-sm divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2 text-left">Nom</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Poste</th>
                            <th class="px-4 py-2 text-left">Département</th>
                            <th class="px-4 py-2 text-left">Date d'embauche</th>
                            <th class="px-4 py-2 text-left">Salaire</th>
                            <th class="px-4 py-2 text-left">Rôme / Poste</th>
                            <th class="px-4 py-2 text-left">Rôles</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($employes as $employe)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 font-medium text-gray-800">{{ $employe->user->name }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ $employe->user->email }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ $employe->poste }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ $employe->departement->name ?? 'Non assigné' }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ \Carbon\Carbon::parse($employe->date_embauche)->format('d/m/Y') }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ number_format($employe->salaire, 2, ',', ' ') }} $</td>
                                <td class="px-4 py-2 text-gray-600">{{ optional($employe->manager)->user->name ?? '-' }}</td>
                                <td class="px-4 py-2">
                                    @foreach($employe->user->getRoleNames() as $role)
                                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1">
                                            {{ $role }}
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
