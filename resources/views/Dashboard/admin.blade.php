@extends('layouts.app')

@section('content')
<h2>Tableau de bord Admin</h2>

<p>Bienvenue, {{ Auth::user()->name }}. Vous pouvez gérer les utilisateurs, les départements et les employés.</p>

<ul>
    <li><a href="{{ route('users.index') }}">👤 Gérer les utilisateurs</a></li>
    <li><a href="{{ route('departements.index') }}">🏢 Gérer les départements</a></li>
    <li><a href="{{ route('employes.index') }}">🧑‍💼 Gérer les employés</a></li>
</ul>

<h3>Créer un nouvel utilisateur</h3>
<form method="POST" action="{{ route('users.store') }}">
    @csrf

    <input type="text" name="name" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>

    <select name="role" required>
        <option value="">-- Choisir un rôle --</option>
        <option value="Admin">Admin</option>
        <option value="RH">RH</option>
        <option value="Manager">Manager</option>
        <option value="Employe">Employé</option>
    </select>

    {{-- uniquement si Employe ou Manager --}}
    <input type="text" name="poste" placeholder="Poste RH (si employé)" />
    <input type="number" name="salaire" step="0.01" placeholder="Salaire (optionnel)" />
    <input type="date" name="date_embauche" placeholder="Date d’embauche" />

    <select name="departement_id">
        <option value="">-- Département (optionnel) --</option>
        @foreach(App\Models\Departement::all() as $dep)
            <option value="{{ $dep->id }}">{{ $dep->name }}</option>
        @endforeach
    </select>
    
    <button type="submit">Créer</button>
</form>


@endsection
