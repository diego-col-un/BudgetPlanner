<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     * Estos nombres deben coincidir con las columnas de la migración.
     * Incluimos las FKs (user_id, category_id) y los campos de datos.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'transaction_type', // <-- ¡IMPORTANTE! Coincide con la migración
        'description',
        'transaction_date',
        'user_id',          // Necesario para la creación en el Controller
        'category_id',      // Foreign Key de la categoría global
    ];

    /**
     * Los atributos que deben ser casteados a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        // Aseguramos que transaction_date sea un objeto Date
        'transaction_date' => 'date', 
    ];


    // ------------------------------------
    // RELACIONES
    // ------------------------------------

    /**
     * Una transacción pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Una transacción pertenece a una categoría (GLOBAL).
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}