@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-6 space-y-6">

    {{-- Titre --}}
    <h2 class="text-2xl font-bold text-gray-800">📃 Mon statut RH</h2>

    {{-- Résumé des congés --}}
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Résumé de mes congés</h3>

        <ul class="divide-y divide-gray-200 text-sm">
            <li class="flex justify-between py-3">
                <span>Total de demandes</span>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">{{ $total }}</span>
            </li>
            <li class="flex justify-between py-3">
                <span>En attente</span>
                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium">{{ $enAttente }}</span>
            </li>
            <li class="flex justify-between py-3">
                <span>Approuvés</span>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">{{ $approuves }}</span>
            </li>
            <li class="flex justify-between py-3">
                <span>Rejetés</span>
                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-medium">{{ $rejetes }}</span>
            </li>
        </ul>
    </div>

    {{-- Message RH --}}
    <p class="text-sm text-gray-500 mt-4">📩 Pour toute question ou correction, contactez votre responsable RH.</p>
</div>
@endsection
