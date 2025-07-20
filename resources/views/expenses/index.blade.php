@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestion des Dépenses</h1>
    <p>Liste des dépenses enregistrées dans le système</p>

    <div class="mb-4">
        <a href="{{ route('expenses.export.excel') }}" class="btn btn-success">Export Excel</a>
        <a href="{{ route('expenses.export.pdf') }}" class="btn btn-danger">Export PDF</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>DATE</th>
                <th>DOSSIER</th>
                <th>FOURNISSEUR</th>
                <th>PAYÉ ?</th>
                <th>HT</th>
                <th>TTC</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->date->format('d/m/Y') }}</td>
                <td>{{ $expense->client->prenom }} {{ $expense->client->nom_assure }} #{{ $expense->client->reference_client }}</td>
                <td>{{ $expense->fournisseur->nom_societe }}</td>
                <td>
                    @if($expense->paid_status == 'paid')
                        OUI
                    @elseif($expense->paid_status == 'pending')
                        En attente
                    @else
                        Non
                    @endif
                </td>
                <td>{{ number_format($expense->ht_amount, 2, ',', ' ') }} €</td>
                <td>{{ number_format($expense->ttc_amount, 2, ',', ' ') }} €</td>
                <td>
                    <a href="#" class="btn btn-sm btn-primary">Modifier</a>
                    <form action="#" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        Affichage {{ $expenses->firstItem() }} à {{ $expenses->lastItem() }} sur {{ $expenses->total() }} résultats
    </div>
    {{ $expenses->links() }}
</div>
@endsection