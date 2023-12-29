<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = ['codeFacture','client_id','entreprise_id','devis_id', 'banque_id','date','devis'];
    
    // Relationship: Each Facture belongs to one Devis
    public function devis()
    {
        return $this->belongsTo(Devis::class,'devis_id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class,'client_id'); 
    }
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class,'entreprise_id');
    }
    public function banque()
    {
        return $this->belongsTo(Banque::class,'banque_id');
    }
    public function paiments()
    {
        return $this->hasMany(Paiment::class);
    }
    public function detailFacture()
    {
        return $this->hasMany(DetailFacture::class);
    }

}