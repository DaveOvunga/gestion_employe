@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-6">

    {{-- Titre de la page --}}
    <h2 class="text-2xl font-bold text-gray-800">📋 Tableau de bord RH</h2>

    {{-- Message de bienvenue --}}
    <div class="bg-white shadow rounded p-4 text-gray-700">
        <p>Bienvenue, <span class="font-semibold">{{ Auth::user()->name }}</span>. 👋</p>
        <p class="text-sm text-gray-500 mt-1">Vous pouvez gérer les informations des employés, les absences et les congés.</p>
    </div>

    {{-- Liens vers les fonctionnalités RH --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <a href="{{ route('employes.index') }}" class="dashboard-link bg-blue-100 text-blue-800">
            🧑‍💼 Gérer les employés
        </a>

        <a href="{{ route('absences.index') }}" class="dashboard-link bg-yellow-100 text-yellow-800">
            📅 Gérer les absences
        </a>

        <a href="{{ route('conges.index') }}" class="dashboard-link bg-green-100 text-green-800">
            📝 Gérer les congés
        </a>
    </div>

</div>
@endsection
