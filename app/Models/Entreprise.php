<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'logo',
        'typelogo',
        'ice',
        'patente',
        'if',
        'cnss',
        'tva',
        'rc',
        'adresse',
        'telephone',
        'email',
        'rib',
        'banque',
        'swift',
        'iban',
        'site',
        'default',
        'validite',
    ];

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }
    public function devis()
    {
        return $this->hasMany(Devis::class);
    }
}