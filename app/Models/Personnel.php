<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'utilisateur_id',
        'entreprise_id'
        
    ];
     public function utilisateur () {
        return $this->belongsTo(User::class);
    }

    public function tickets () {
        return $this->hasMany(Ticket::class);
    }
}