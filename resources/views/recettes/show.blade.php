@extends('layouts.app')

@section('title', $recette->titre)

@section('content')
    <a href="{{ route('recettes.index') }}" class="btn btn-secondary mb-3">← Retour</a>

    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-4">{{ $recette->titre }}</h1>

            @if ($recette->image)
                <img src="{{ asset('storage/' . $recette->image) }}" alt="{{ $recette->titre }}" class="img-fluid rounded mb-4">
            @endif

            <div class="card mb-4">
                <div class="card-body">
                    <p><strong> Temps:</strong> {{ $recette->temps_preparation }} minutes</p>
                    @if ($recette->category)
                        <p><strong> Catégorie:</strong> {{ $recette->category->nom }}</p>
                    @endif
                    <p><strong> Créée:</strong> {{ $recette->created_at->format('d/m/Y à H:i') }}</p>
                </div>
            </div>

            @if ($recette->description)
                <h3 class="mb-3"> Description</h3>
                <p>{{ $recette->description }}</p>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('recettes.edit', $recette) }}" class="btn btn-warning"> Éditer</a>
        <form action="{{ route('recettes.destroy', $recette) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cette recette?')"> Supprimer</button>
        </form>
    </div>
@endsection
