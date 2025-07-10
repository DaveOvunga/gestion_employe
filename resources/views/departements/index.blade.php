@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6">

    {{-- Titre --}}
    <h2 class="text-2xl font-bold text-gray-800 mb-4">🏢 Mon département</h2>

    {{-- Tableau des départements --}}
    <div class="bg-white p-6 rounded shadow">
        @if($departements->isEmpty())
            <p class="text-gray-500">Aucun département trouvé.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2 text-left">Nom</th>
                            <th class="px-4 py-2 text-left">Description</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($departements as $departement)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 font-medium text-gray-800">{{ $departement->name }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ $departement->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
