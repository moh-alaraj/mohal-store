<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','first_name','last_name','email','country_code','city','phone_number','total','status'];
    protected $casts=[
        'total' => 'float',
    ];


    public function items(){

        return $this->hasMany(OrderItem::class);
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
