<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ability extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name'
    ];

    public function RoleAbility():BelongsTo
    {
        return $this->belongsTo(RoleAbility::class);
    }
}
