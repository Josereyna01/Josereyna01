<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Importa HasMany para la relación con Afiliacion

class User extends Authenticatable
{
    use HasFactory, HasRoles;
    protected $table ='users';

    protected $fillable = [
        'name',
        'apellido_paterno',
        'apellido_materno',
        'password',
        'celular',
        'sucursal',
        'estatus',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Define la relación muchos a muchos con el modelo Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Define la relación uno a muchos con el modelo Afiliacion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function afiliaciones(): HasMany
    {
        return $this->hasMany(Afiliacion::class, 'user_id');
    }
    
}
