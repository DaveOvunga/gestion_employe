@extends('layouts.app')

@section('content')
<h2>Tableau de bord RH</h2>

<p>Bienvenue, {{ Auth::user()->name }}. Vous pouvez gérer les informations des employés, les absences et les congés.</p>

<ul>
    <li><a href="{{ route('employes.index') }}">🧑‍💼 Gérer les employés</a></li>
    <li><a href="{{ route('absences.index') }}">📅 Gérer les absences</a></li>
    <li><a href="{{ route('conges.index') }}">📝 Gérer les congés</a></li>
</ul>
@endsection
