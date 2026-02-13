@extends('layouts.app')

@section('title', 'Recettes')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Recettes</h1>
        <a href="{{ route('recettes.create') }}" class="btn btn-primary">+ Nouvelle recette</a>
    </div>

    @if ($recettes->isEmpty())
        <div class="alert alert-info text-center">
            Aucune recette pour l'instant. <a href="{{ route('recettes.create') }}" class="alert-link">Créez votre première recette</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Titre</th>
                        <th>Temps (min)</th>
                        <th>Créée le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            <tbody>
                @foreach ($recettes as $recette)
                    <tr>
                        <td><strong>{{ $recette->titre }}</strong></td>
                        <td>{{ $recette->temps_preparation }}</td>
                        <td><small class="text-muted">{{ $recette->created_at->format('d/m/Y H:i') }}</small></td>
                        <td>
                            <a href="{{ route('recettes.show', $recette) }}" class="btn btn-sm btn-info">Voir</a>
                            <a href="{{ route('recettes.edit', $recette) }}" class="btn btn-sm btn-warning">Éditer</a>
                            <form action="{{ route('recettes.destroy', $recette) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette recette?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    @endif
@endsection
