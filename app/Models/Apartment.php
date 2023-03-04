<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;
    protected $fillable =[
        'number',
        'block',
        'condominia_id',
    ];

    public function condominia()
    {
        return $this->hasMany(Condominia::class, 'id', 'condominia_id');
    }

}
