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
        'admin_id', 
        'horaires',
        'statut',
        'bio',
        'image'    
    ];

    protected $casts = [
        'horaires' => 'array',
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

    public function agences (){
        return $this->hasMany(Agence::class);
    }

    /**
     * Vérifie si l'entreprise est ouverte à un jour et une heure donnés
     */
    public function estOuvert($jour, $heure)
    {
        if (!$this->horaires || !isset($this->horaires[$jour])) {
            return false;
        }

        $jourData = $this->horaires[$jour];

        // Si le jour est marqué comme fermé
        if ($jourData['ferme'] ?? true) {
            return false;
        }

        // Vérifier si l'heure est dans une des plages horaires
        $plages = $jourData['plages'] ?? [];
        foreach ($plages as $plage) {
            if ($heure >= $plage['debut'] && $heure <= $plage['fin']) {
                return true;
            }
        }

        return false;
    }

    /**
     * Récupère les plages horaires d'un jour donné
     */
    public function getPlagesHoraires($jour)
    {
        if (!$this->horaires || !isset($this->horaires[$jour])) {
            return [];
        }

        $jourData = $this->horaires[$jour];
        
        if ($jourData['ferme'] ?? true) {
            return [];
        }

        return $jourData['plages'] ?? [];
    }

    /**
     * Récupère la liste des jours d'ouverture
     */
    public function getJoursOuverture()
    {
        if (!$this->horaires) {
            return [];
        }

        $joursOuverts = [];
        foreach ($this->horaires as $jour => $data) {
            if (!($data['ferme'] ?? true) && !empty($data['plages'])) {
                $joursOuverts[] = $jour;
            }
        }

        return $joursOuverts;
    }

    /**
     * Retourne un résumé textuel des jours ouverts
     */
    public function getJoursOuvertsTexte()
    {
        $jours = $this->getJoursOuverture();
        
        if (empty($jours)) {
            return 'Aucun jour défini';
        }

        // Abréviations des jours
        $abreviations = [
            'Lundi' => 'Lun',
            'Mardi' => 'Mar',
            'Mercredi' => 'Mer',
            'Jeudi' => 'Jeu',
            'Vendredi' => 'Ven',
            'Samedi' => 'Sam',
            'Dimanche' => 'Dim'
        ];

        $joursAbreges = array_map(function($jour) use ($abreviations) {
            return $abreviations[$jour] ?? $jour;
        }, $jours);

        return implode(', ', $joursAbreges);
    }

    /**
     * Vérifie si tous les jours ouverts ont les mêmes horaires
     */
    public function hasHorairesUniformes()
    {
        if (!$this->horaires) {
            return false;
        }

        $plagesReference = null;
        
        foreach ($this->horaires as $jour => $data) {
            if ($data['ferme'] ?? true) {
                continue;
            }

            $plages = $data['plages'] ?? [];
            
            if ($plagesReference === null) {
                $plagesReference = $plages;
            } elseif ($plages !== $plagesReference) {
                return false;
            }
        }

        return $plagesReference !== null;
    }

    /**
     * Retourne un résumé des horaires
     */
    public function getHorairesResume()
    {
        if (!$this->horaires) {
            return 'Non configuré';
        }

        $joursOuverts = $this->getJoursOuverture();
        
        if (empty($joursOuverts)) {
            return 'Fermé';
        }

        if ($this->hasHorairesUniformes()) {
            // Récupérer les plages du premier jour ouvert
            foreach ($this->horaires as $jour => $data) {
                if (!($data['ferme'] ?? true) && !empty($data['plages'])) {
                    $plages = $data['plages'];
                    $plagesTexte = array_map(function($plage) {
                        return substr($plage['debut'], 0, 5) . '-' . substr($plage['fin'], 0, 5);
                    }, $plages);
                    return implode(', ', $plagesTexte);
                }
            }
        }

        return 'Horaires variables';
    }
}
