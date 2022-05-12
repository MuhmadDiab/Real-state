<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates=['deleted_at'];
    use HasFactory;

    protected $table = "estates";

    protected $fillable = [

        'name',
        'description'   ,
        'roomnumber',
        'state',
        'price',
        'local',
        'lan',
        'lat',
        'photo',
        'bathroomnumber',
        'bedroomnumber',
       'propartytype',

    ];
    protected $hidden = [
        'updated_at',
        'created_at'
    ];
}
