@extends('layouts.app')

@section('content')
<h2>📃 Mon statut RH</h2>

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">Résumé de mes congés</h5>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between">
                <span>Total de demandes</span>
                <span class="badge bg-primary">{{ $total }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>En attente</span>
                <span class="badge bg-warning text-dark">{{ $enAttente }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Approuvés</span>
                <span class="badge bg-success">{{ $approuves }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Rejetés</span>
                <span class="badge bg-danger">{{ $rejetes }}</span>
            </li>
        </ul>
    </div>
</div>

<p class="text-muted"> Pour toute question ou correction, contactez votre responsable RH.</p>
@endsection
