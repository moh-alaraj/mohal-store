<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

     protected $fillable = [
         'name', 'slug','description','logo','currency','locale','status'
     ];

    public function products(){

        return $this->hasMany(Product::class,'store_id','id');

    }

    public function getImageLinkAttribute()
    {

        if ($this->logo) {
            return $this->logo ? url('/') . '/images/' . $this->logo : url('/') . '';
        }
        return asset('/images/plchold.jpg');
    }
}
