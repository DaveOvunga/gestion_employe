@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Tableau de bord Admin</h2>

    <div class="mb-6 bg-white shadow rounded p-4">
        <p class="text-gray-700">Bienvenue, <span class="font-semibold">{{ Auth::user()->name }}</span> 👋</p>
        <p class="text-sm text-gray-600">Vous pouvez gérer les utilisateurs, les départements et les employés.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-10">
        <a href="{{ route('users.index') }}" class="bg-blue-100 hover:bg-blue-200 text-blue-800 font-medium py-3 px-4 rounded shadow flex items-center justify-center">
            👤 Gérer les utilisateurs
        </a>
        <a href="{{ route('departements.index') }}" class="bg-green-100 hover:bg-green-200 text-green-800 font-medium py-3 px-4 rounded shadow flex items-center justify-center">
            🏢 Gérer les départements
        </a>
        <a href="{{ route('employes.index') }}" class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-medium py-3 px-4 rounded shadow flex items-center justify-center">
            🧑‍💼 Gérer les employés
        </a>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Créer un nouvel utilisateur</h3>

        <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <input type="text" name="name" placeholder="Nom" required class="input-style">
                <input type="email" name="email" placeholder="Email" required class="input-style">
                <input type="password" name="password" placeholder="Mot de passe" required class="input-style">
                
                <select name="role" required class="input-style">
                    <option value="">-- Choisir un rôle --</option>
                    <option value="Admin">Admin</option>
                    <option value="RH">RH</option>
                    <option value="Manager">Manager</option>
                    <option value="Employe">Employé</option>
                </select>

                <input type="text" name="poste" placeholder="Poste RH (si employé)" class="input-style">
                <input type="number" name="salaire" step="0.01" placeholder="Salaire (optionnel)" class="input-style">
                <input type="date" name="date_embauche" class="input-style">
                
                <select name="departement_id" class="input-style">
                    <option value="">-- Département (optionnel) --</option>
                    @foreach(App\Models\Departement::all() as $dep)
                        <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded shadow">
                    ➕ Créer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
