<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','entreprise_id', 'codeDevis', 'banque_id','designationDev' ,'conditionsDeReglement','date','devis'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }
    public function factures()
    {
        return $this->hasMany(Facture::class);
    }
    public function banque()
    {
        return $this->belongsTo(Banque::class,'banque_id');
    }
    public function detailDevis()
    {
        return $this->hasMany(DetailDevis::class);
    }
}
