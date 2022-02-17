<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function land()
    {
        return $this->belongsTo(Land::class);
    }

    protected $fillable = array('name');
}
