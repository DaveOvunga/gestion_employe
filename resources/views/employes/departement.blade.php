@extends('layouts.app')

@section('content')
<h2>🏢 Mon département : {{ $departement->nom }}</h2>
<p>Manager : {{ $equipe->firstWhere('id', $equipe->first()->manager_id)->user->name ?? 'Non assigné' }}</p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Poste</th>
            <th>Salaire</th>
        </tr>
    </thead>
    <tbody>
        @foreach($equipe as $membre)
        <tr>
            <td>{{ $membre->user->name }}</td>
            <td>{{ $membre->poste }}</td>
            <td>{{ number_format($membre->salaire, 2, ',', ' ') }} $</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
