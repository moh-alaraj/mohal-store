<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

     protected $fillable = ['name','slug','store_id','category_id','description','image','price','sale_price','quantity','status'];


    public function category(){

        return $this->belongsTo(Category::class,'category_id','id')->withDefault();

    }
    public function store(){

        return $this->belongsTo(Store::class,'store_id','id')->withDefault();
    }
    public function tags(){

        return $this->belongsToMany(Tag::class,'product_tag','product_id','tag_id','id','id');
    }

    public function images(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }


    public function getImageLinkAttribute()
    {

        if ($this->image) {
            return $this->image ? url('/') . '/images/' . $this->image : url('/') . '';
        }
        return asset('/images/plchold.jpg');
    }
}
