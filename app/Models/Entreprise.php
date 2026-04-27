<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_ent',
        'adresse',
        'heure_ouv',
        'heure_ferm',
        'admin_id', 
        'jour_ouv',
        'statut',
        'bio',
        'image'    
    ];

    public function services (){
      return $this->hasMany(Service::class);
    }

    public function admin (){
        return $this->belongsTo(Admin::class);
    }

     public function personnels (){
      return $this->hasMany(Personnel::class);
    }

}


