<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'libelle',
        'entreprise_id',
        'temps_estime',     
    ];
    public function entreprise () {
       return $this->belongsTo(Entreprise::class); 
    }

    public function clients (){
        return $this->belongsToMany(Client::class,'tickets','service_id','client_id')
        ->withPivot('numero','type','statut','date_debut_traitement','date_fin_traitement');

    }
    public function files_attentes (){
        return $this->hasMany(FileAttente::class);
    }
}





