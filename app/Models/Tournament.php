<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Player;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'winner_id',
        'players'
    ];

    public function players()
    {
        return $this->belongsToMany(Player::class);
    }

    public function winner()
    {
        return $this->belongsTo(Player::class, 'winner_id');
    }

    

    public function simulateTournament(array $playerIds): int {
        $players_round = Player::whereIn('id', $playerIds)->get();
        while(count($players_round) > 1) {
            $player1 = $players_round->shift();
            $player2 = $players_round->shift();
            $winner = $this->simulateGame($player1, $player2);    
            $players_round->push($winner);
        }
        return $players_round->first()->id;
    }

    public function simulateGame(Player $player1, Player $player2): Player {
        if ($player1->getPointsForMatch() > $player2->getPointsForMatch()) {
            return $player1;
        } 
        return $player2;
    }
}
