<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Anuncio extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $guarded = [];

    protected $dates = ["reserved_at",'available_at','dalivered_at'];

    public function user(){
        return $this->belongsTo(User::class,"user_id",'id');
        //return User::find($this->user_id);
    }

    public function buyer(){
        return $this->belongsTo(User::class,"buyer_id",'id');
        //return User::find($this->user_id);
    }

    public function pickPoint(){
        return $this->hasOne(PickPoint::class,"id","pickpoint_selected");
    }
}
