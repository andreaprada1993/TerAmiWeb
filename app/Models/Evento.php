<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    // validacion de los datos de eventos es decir tabla agregar recordatorio

    static $rules = [
        'title' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'start' => 'required|date',
        'end' => 'required|date|after_or_equal:start',
    ];

    protected $fillable = [
        'title',
        'descripcion',
        'start',
        'end',
        'user_id' // 🔑 importante para identificar al usuario dueño del evento
    ];

   // Relación: Un evento pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
