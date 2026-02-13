<h1>Votre recette: {{ $recette->titre }}</h1>
<p>Bonjour,</p>
<p>Merci! Votre recette a été créée avec succès.</p>

<h3>Détails:</h3>
<ul>
    <li>Titre: {{ $recette->titre }}</li>
    <li>Temps: {{ $recette->temps_preparation }} min</li>
    @if ($recette->category)
        <li>Catégorie: {{ $recette->category->nom }}</li>
    @endif
</ul>

<p><a href="{{ route('recettes.show', $recette) }}">Voir la recette</a></p>
<p>IFIAG Recettes</p>
