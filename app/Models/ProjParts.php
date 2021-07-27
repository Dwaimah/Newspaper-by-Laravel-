<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjParts extends Model
{
    use HasFactory;
    protected $table='projectparts';
     protected $primarykey= 'projpartid';

}
