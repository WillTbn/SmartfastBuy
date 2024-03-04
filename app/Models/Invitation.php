<?php

namespace App\Models;

use App\Jobs\AdmSystem\SendEmailInvatationJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Invitation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['email', 'name', 'token','data', 'created_at', 'updated_at', 'deleted_at'];

    protected static function booted():void
    {
        static::updating(function (Invitation $invitation){
            $invitation->token = Str::uuid();
        });
        static::updated(
            fn (Invitation $invitation) => SendEmailInvatationJob::dispatch($invitation)->delay(2)
        );
    }

}
