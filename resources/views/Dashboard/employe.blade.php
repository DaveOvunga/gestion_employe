@extends('layouts.app')

@section('content')
<h2>Bienvenue {{ Auth::user()->name }}</h2>

<h3>Mon profil</h3>
<form method="POST" action="{{ route('update.me') }}">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Nom">
    <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Email">
    <button type="submit">Mettre à jour</button>
</form>

<h3> Mon espace</h3>
<ul>
    <li><a href="{{ route('employe.absences') }}">📅 Mes absences</a></li>
    <li><a href="{{ route('employe.conges') }}">📊 Historique de mes congés</a></li>
    <li><a href="{{ route('employe.departement') }}">🏢 Mon département et équipe</a></li>
    <li><a href="{{ route('employe.statut_rh') }}">📃 Mon statut RH</a></li>    
</ul>

<h3>Demander un congé</h3>
<form method="POST" action="{{ route('conges.store') }}">
    @csrf
    <input type="date" name="date_debut" required>
    <input type="date" name="date_fin" required>
     
    <select name="type_conge" required>
        <option value="">-- Sélectionner le type de congé --</option>
        <option value="Annuel">Annuel</option>
        <option value="Maladie">Maladie</option>
        <option value="Exceptionnel">Exceptionnel</option>
    </select>

    <button type="submit">Envoyer</button>
</form>

<h3>Mes congés</h3>
<ul>
    @foreach ($conges as $conge)
        <li>{{ $conge->date_debut }} → {{ $conge->date_fin }} ({{ $conge->statut }})</li>
    @endforeach
</ul>
@endsection
