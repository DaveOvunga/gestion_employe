@extends('layouts.app')

@section('content')
<h2>🧑‍💼 Liste des employés</h2>

<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Poste</th>
            <th>Département</th>
            <th>Date d'embauche</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employes as $employe)
        <tr>
            <td>{{ $employe->user->name }}</td>
            <td>{{ $employe->poste }}</td>
            <td>{{ $employe->departement->name ?? 'N/A' }}</td>
            <td>{{ $employe->date_embauche }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
