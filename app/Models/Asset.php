<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [


         'Type',
         'SerialNumber',
         'Description',
         'FixedorMovable',
          'Picture_path',
           'Purchasedate',
           'Start_use_date',
           'Purchaseprice',
           'user_id',
           'WarrantyExpirydate',
           'Degradationinyears',
           'CurrentValueinnaira',
            'Location'


   ];
}
