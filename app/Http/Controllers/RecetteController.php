<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Category;
use App\Mail\RecetteCreee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class RecetteController extends Controller
{
    
    public function index()
    {
        $recettes = Recette::all();
        return view('recettes.index', compact('recettes'));
    }

    public function testEmail()
    {
        $recette = Recette::first() ?? Recette::create([
            'titre' => 'Recette Test',
            'temps_preparation' => 30,
            'description' => 'Une recette de test'
        ]);
        
        return new RecetteCreee($recette);
    }

    public function create()
    {
        $categories = Category::all();
        return view('recettes.create', compact('categories'));
    }

   
    public function store(Request $request)
    {
       
        $validated = $request->validate([
            'titre' => 'required|max:100',
            'description' => 'nullable|string',
            'temps_preparation' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('recettes', 'public');
            $validated['image'] = $imagePath;
        }

        $recette = Recette::create($validated);

        Mail::to('ifiag@gmail.com')->send(new RecetteCreee($recette));

        return redirect()->route('recettes.index')->with('success', 'Recette créée avec succès');
    }

    
    public function show(Recette $recette)
    {
        return view('recettes.show', compact('recette'));
    }

    
    public function edit(Recette $recette)
    {
        $categories = Category::all();
        return view('recettes.edit', compact('recette', 'categories'));
    }

    
    public function update(Request $request, Recette $recette)
    {
        
        $validated = $request->validate([
            'titre' => 'required|max:100',
            'description' => 'nullable|string',
            'temps_preparation' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id'
        ]);

       
        if ($request->hasFile('image')) {
            
            if ($recette->image) {
                Storage::disk('public')->delete($recette->image);
            }

            $image = $request->file('image');
            $imagePath = $image->store('recettes', 'public');
            $validated['image'] = $imagePath;
        }

     
        $recette->update($validated);

        return redirect()->route('recettes.show', $recette)->with('success', 'Recette mise à jour avec succès');
    }

    
    public function destroy(Recette $recette)
    {
       
        if ($recette->image) {
            Storage::disk('public')->delete($recette->image);
        }

        $recette->delete();

        return redirect()->route('recettes.index')->with('success', 'Recette supprimée avec succès');
    }
}
