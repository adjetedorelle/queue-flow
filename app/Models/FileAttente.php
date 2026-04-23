<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileAttente extends Model
{
    use HasFactory;

    protected $table = 'files_attente';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'nb_client_restant',
        'nb_total',
        'statut',
        'service_id',     
    ];  
    public function service (){
        return $this->belongsTo(Service::class);
    }
}
