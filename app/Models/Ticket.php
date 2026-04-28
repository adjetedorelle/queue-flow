<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'numero',
        'type',
        'jour_passage',
        'statut',
        'date_debut_traitement', 
        'date_fin_traitement',
        'client_id',
        'service_id',
        'heure_exact',
        'personnel_id',
        'rappel_minutes',
        'file_attente_id',
        'motif',
    ];
    public function service () {
        return $this->belongsTo(Service::class);
    }

    public function client () {
        return $this->belongsTo(Client::class);
    }

    public function personnel () {
        return $this->belongsTo(Personnel::class);
    }

    public function fileAttente () {
        return $this->belongsTo(FileAttente::class);
    }
}


