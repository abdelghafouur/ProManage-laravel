<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiment extends Model
{
    use HasFactory;
    protected $fillable = ['facture_id','date','montant','note','method','numero'];
    // Relationship: Each Facture belongs to one Devis
    public function facture()
    {
        return $this->belongsTo(Facture::class,'facture_id');
    }

}