<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $description
 * @property string $title
 * @property string $slug
 * @property string $site
 * @property string $ratingBank
 * @property string $phone
 * @property string $logo
 * @property string $legalAddress
 * @property string $email
 * @property int $created_at
 * @property int $updated_at
 * @property Branches $branches
 */
class Banks extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banks';

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
        'description', 'created_at', 'updated_at', 'title', 'slug', 'site', 'ratingBank', 'phone', 'logo', 'legalAddress', 'email'
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
        'description' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'title' => 'string', 'slug' => 'string', 'site' => 'string', 'ratingBank' => 'string', 'phone' => 'string', 'logo' => 'string', 'legalAddress' => 'string', 'email' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    // Scopes...
    public function scopeIdBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function scopeGetById($query, $id)
    {
        return $query->where('id', $id);
    }

    // Functions ...

    // Relations ...

    public function branches()
    {
        return $this->hasMany(Branches::class,'bankId', 'id');
    }
}
