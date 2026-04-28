<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'utilisateur_id',
        'vip'
    ];
       public function services (){
        return $this->belongsToMany(Service::class,'tickets','client_id','service_id')
        ->withPivot('numero','type','statut','date_debut_traitement','date_fin_traitement');
       }
       public function notifications (){
        return $this->hasMany(Notification::class);
       }

        public function utilisateur () {
        return $this->belongsTo(User::class);
    }
}
