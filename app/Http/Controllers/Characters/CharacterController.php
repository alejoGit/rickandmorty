<?php

namespace App\Http\Controllers\Characters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Character;

class CharacterController extends Controller
{  
    public function index(Request $request)
    {
        $characters = Character::where('name', 'like', '%'.$request->name.'%')
                                ->when($request->species, function ($query, $species) {
                                    $query->where('species', $species);
                                })
                                ->paginate(100);
        $name = $request->name;
        $species =$request->species;
        return view('characters.index', compact('characters', 'name', 'species') );
    }

    public function show(Character $character)
    {
        return view('characters.detail', compact('character') );
    }

}
