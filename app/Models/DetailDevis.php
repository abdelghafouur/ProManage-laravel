<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDevis extends Model
{
    use HasFactory;

    protected $fillable = ['devis_id', 'designation', 'puht', 'qte', 'tva'];

    // Relationship: Each DetailDevis belongs to one Devis
    public function devis()
    {
        return $this->belongsTo(Devis::class, 'devis_id');
    }
    
}
