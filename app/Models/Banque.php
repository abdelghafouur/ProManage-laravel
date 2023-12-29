<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banque extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'rib','swift','iban'];
    // Add other attributes as needed

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }
    public function devis()
    {
        return $this->hasMany(Devis::class);
    }
}
