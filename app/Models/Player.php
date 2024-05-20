<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    const LUCK_VALUE = 10;

    protected $fillable = [
        'name',
        'gender_id',
        'skill_id',
        'updated_at',
        'deleted_at'
    ];
    
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

     public function tournaments(): BelongsToMany {
        return $this->belongsToMany(Tournament::class);
    }


    public function getPointsForMatch(): int {
        $playerLuck = rand(1, self::LUCK_VALUE);
        if($this->gender_id == Gender::MALE) {
            return ($this->ability + $this->streng + $this->speed) * $playerLuck;
        } else {
            return ($this->ability + $this->reaction) * $playerLuck;
        }
    }
}
