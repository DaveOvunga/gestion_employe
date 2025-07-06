@extends('layouts.app')

@section('content')
<h2>Tableau de bord Manager</h2>

<p>Bienvenue, {{ Auth::user()->name }}. Voici les membres de votre équipe et leurs demandes de congé.</p>

@if($equipe->isEmpty())
    <p>Aucun membre dans votre équipe.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Poste</th>
                <th>Département</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipe as $employe)
                <tr>
                    <td>{{ $employe->user->name }}</td>
                    <td>{{ $employe->poste }}</td>
                    <td>{{ $employe->departement->name ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<p><a href="{{ route('conges.index') }}">📄 Voir les demandes de congé</a></p>
@endsection
