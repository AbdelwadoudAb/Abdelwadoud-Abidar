@extends('layouts.app')

@section('title', 'Créer une recette')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">Créer une nouvelle recette</h1>

            <form action="{{ route('recettes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="titre" class="form-label">Titre *</label>
                    <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre') }}" required>
                    @error('titre')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="temps_preparation" class="form-label">Temps de préparation (minutes) *</label>
                    <input type="number" class="form-control" id="temps_preparation" name="temps_preparation" value="{{ old('temps_preparation') }}" required>
                    @error('temps_preparation')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Catégorie</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="">-- Sélectionnez une catégorie --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                {{ $category->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <small class="text-muted">JPEG, PNG, JPG, GIF (max 2MB)</small>
                    @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button type="submit" class="btn btn-primary">Créer la recette</button>
                    <a href="{{ route('recettes.index') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection
