@extends('layouts.app')

@section('content')
<h2>Mon département</h2>

<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $departement->name }}</td>
            <td>{{ $departement->description }}</td>
        </tr>
    </tbody>
</table>
@endsection
