@extends('layouts.app')

@section('content')
<h2>📅 Mes absences</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Motif</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        @foreach($absences as $absence)
        <tr>
            <td>{{ \Carbon\Carbon::parse($absence->date)->format('d/m/Y') }}</td>
            <td>{{ $absence->motif }}</td>
            <td>
                @if($absence->statut === 'justifie')
                    <span class="badge bg-success">Justifié</span>
                @else
                    <span class="badge bg-danger">Non justifié</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
