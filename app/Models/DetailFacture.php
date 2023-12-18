<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFacture extends Model
{
    use HasFactory;

    protected $fillable = ['facture_id', 'designation', 'puht', 'qte', 'tva'];

    // Relationship: Each DetailFacture belongs to one Facture
    public function facture()
    {
        return $this->belongsTo(Facture::class, 'facture_id');
    }
}
