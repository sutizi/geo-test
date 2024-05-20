<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use \Illuminate\Http\Response;

class TournamentController extends Controller
{
   
    public function index()
    {
        $tournaments = Tournament::all();

        return response()->json($tournaments);
    }


    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'player_ids' => 'required|array',
            'player_ids.*' => 'exists:players,id',
        ]);

        $tournament = Tournament::create([
            'name' => $validatedData['name'],
            'date' => $validatedData['date'],
        ]);

        $winnerId = $tournament->simulateTournament($validatedData['player_ids']);
        $tournament->update(['winner_id' => $winnerId]);
    

        return response()->json(['tournament' => $tournament], 201);
    }

    public function show(int $id)
    {
         $tournament = Tournament::find($id);
        if (!$tournament) {
            return response()->json(['error' => 'Tournament not found'], 404);
        }
        return response()->json($tournament);    
    }

}
