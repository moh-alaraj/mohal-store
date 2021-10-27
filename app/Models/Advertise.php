<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{

    use HasFactory;


    protected $fillable = ['photo','title'];




    public function getImageLinkAttribute()
    {

        if ($this->photo) {
            return $this->photo ? url('/') . '/images/' . $this->photo : url('/') . '';
        }
        return asset('/images/plchold.jpg');
    }
}
