<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assetass extends Model
{
    use HasFactory;

    protected $fillable = [
         'AssetId',
        'Assignment_date',
         'Status',
        'Is_due',
         'Due_date',
          'Assigned_user_id',
        'Assigned_by',
    ];

    public function Assetfind(){
      return $this->hasOne(Asset::class,'user_id');
    }
}
