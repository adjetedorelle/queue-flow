<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'adresse',
        'entreprise_id'
        
    ];
    public function entreprise () {
        return $this->belongsTo(Entreprise::class);
    }

     public function tickets () {
        return $this->hasMany(Ticket::class);
     }
}
