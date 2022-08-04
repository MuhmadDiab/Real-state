<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estate;
class Like extends Model
{
    use HasFactory;
    protected $fillable = ['estate_id', 'photo'];
    public function estate()
    {
      return $this->belongsTo(Estate::class);

    }
    protected $hidden = [

        'created_at',
        'updated_at',

    ];
}
