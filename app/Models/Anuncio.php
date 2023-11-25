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

    // Los campos que no pueden ser asignados masivamente, al no definir ninguno, podremos editarlos todos masivamente.
    protected $guarded = [];

    // Los campos de fecha que deberían ser tratados como fechas de Carbon (Carbon es una libreria de laravel para tratar con fechas y horas)
    protected $dates = ["reserved_at", 'available_at', 'dalivered_at'];

    // Relación: Un anuncio pertenece a un usuario (vendedor)
    public function user()
    {
        return $this->belongsTo(User::class, "user_id", 'id');
    }

    // Relación: Un anuncio pertenece a un comprador (usuario que ha reservado)
    public function buyer()
    {
        return $this->belongsTo(User::class, "buyer_id", 'id');
    }

    // Relación: Un anuncio tiene un punto de recogida seleccionado
    public function pickPoint()
    {
        return $this->hasOne(PickPoint::class, "id", "pickpoint_selected");
    }
}
