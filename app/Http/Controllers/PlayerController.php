<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Models\Player;
use App\Models\Skill;

class PlayerController extends Controller
{

    public function index()
    {
        $players = Player::all();

        return response()->json($players);
    }


    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'gender_id' => 'required|exists:genders,id',
            'skill.force' => 'required|numeric',
            'skill.velocity' => 'required|numeric',
        ]);

        $name = $request->name;
        $genderId = $request->gender_id;
        $skillForce = $request->input('skill.force');
        $skillVelocity = $request->input('skill.velocity');
        $reaction_time = $request->input('skill.reaction_time');

        $skill = Skill::firstOrCreate([
            'force' => $skillForce,
            'velocity' => $skillVelocity,
            'reaction_time' => $reaction_time
        ]);

        $player = new Player();
        $player->name = $name;
        $player->gender_id = $genderId;
        $player->skill_id = $skill->id;
        $player->save();

        return response()->json(['message' => 'Player created successfully'], 201);
    }

    public function show(int $id)
    {
         $player = Player::find($id);
        if (!$player) {
            return response()->json(['error' => 'Tournament not found'], 404);
        }
        return response()->json($player);    
    }

}
