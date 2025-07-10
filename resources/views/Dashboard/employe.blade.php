@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 space-y-8">

    {{-- Titre de bienvenue --}}
    <h2 class="text-2xl font-bold text-gray-800">Bienvenue {{ Auth::user()->name }}</h2>

    {{-- Section Profil --}}
    <div class="bg-white rounded shadow p-6">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">Mon profil</h3>
        <form method="POST" action="{{ route('update.me') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Nom" class="input-style" required>
                <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Email" class="input-style" required>
            </div>

            <div class="text-right">
                <button type="submit" class="btn-primary">💾 Mettre à jour</button>
            </div>
        </form>
    </div>

    {{-- Mon espace --}}
    <div class="bg-white rounded shadow p-6">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">Mon espace</h3>
        <ul class="space-y-2">            
            <li><a href="{{ route('conges.index') }}" class="link-style">📊 Historique de mes congés</a></li>
            <li><a href="{{ route('departements.index') }}" class="link-style">🏢 Mon département et équipe</a></li>
            <li><a href="{{ route('employe.statut_rh') }}" class="link-style">📃 Mon statut RH</a></li>    
        </ul>
    </div>

    {{-- Formulaire de congé --}}
    <div class="bg-white rounded shadow p-6">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">Demander un congé</h3>
        <form method="POST" action="{{ route('conges.store') }}" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <input type="date" name="date_debut" required class="input-style">
                <input type="date" name="date_fin" required class="input-style">
            </div>

            <select name="type_conge" required class="input-style">
                <option value="">-- Sélectionner le type de congé --</option>
                <option value="Annuel">Annuel</option>
                <option value="Maladie">Maladie</option>
                <option value="Exceptionnel">Exceptionnel</option>
            </select>

            <div class="text-right">
                <button type="submit" class="btn-primary">📤 Envoyer</button>
            </div>
        </form>
    </div>

    {{-- Liste des congés --}}
    <div class="bg-white rounded shadow p-6">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">Mes congés</h3>
        <ul class="space-y-2">
            @forelse ($conges as $conge)
                <li class="text-gray-600">📆 {{ $conge->date_debut }} → {{ $conge->date_fin }} <span class="font-semibold">({{ $conge->statut }})</span></li>
            @empty
                <li class="text-gray-500">Aucun congé enregistré.</li>
            @endforelse
        </ul>
    </div>

</div>
@endsection
