<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $updated_at
 * @property int    $created_at
 * @property string $slug
 * @property string $data
 * @property int $bankId
 */
class Branches extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branches';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'updated_at', 'slug', 'created_at', 'bankId', 'data'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'updated_at' => 'timestamp', 'slug' => 'string', 'created_at' => 'timestamp',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'updated_at', 'created_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value) ? json_decode($value) : null,
            set: fn($value) => is_array($value) ? json_encode($value) : null,
        );
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
