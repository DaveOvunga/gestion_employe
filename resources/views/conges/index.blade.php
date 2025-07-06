@extends('layouts.app')

@section('content')
<h2>📝 Liste des demandes de congé</h2>

<table class="table">
    <thead>
        <tr>
            <th>Employé</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($conges as $conge)
        <tr>
            <td>{{ $conge->employe->user->name ?? 'N/A' }}</td>
            <td>{{ $conge->date_debut }}</td>
            <td>{{ $conge->date_fin }}</td>
            <td>
                @if($conge->statut === 'en_attente')
                    <span class="badge bg-warning text-dark">En attente</span>
                @elseif($conge->statut === 'approuve')
                    <span class="badge bg-success">Approuvé</span>
                @else
                    <span class="badge bg-danger">Rejeté</span>
                @endif
            </td>
            <td>
                @if($conge->statut === 'en_attente')
                <form method="POST" action="{{ route('conges.updateStatut', $conge->id) }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="statut" value="approuve">
                    <button class="btn btn-sm btn-success">✅ Approuver</button>
                </form>

                <form method="POST" action="{{ route('conges.updateStatut', $conge->id) }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="statut" value="rejete">
                    <button class="btn btn-sm btn-danger">❌ Rejeter</button>
                </form>
                @else
                    <em>Aucune action</em>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
