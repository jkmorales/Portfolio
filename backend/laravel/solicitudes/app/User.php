<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'paterno', 'materno', 'email', 'password', 'picture_path', 'fkPerfil', 'fkRecordStatus',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
        'email_verified_at',
        'updated_at',
        'created_at',
        'fkRecordStatus'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function perfil()
    {
        return $this->hasOne('App\Models\Profile','fkPerfil','pkPerfil');
    }

    public function recordStatus()
    {
        return $this->belongsTo('App\Models\RecordStatus', 'fkRecordStatus', 'pkRecordStatus');
    }

    public function solicitudes()
    {
        return $this->hasMany('App\Models\Request', 'fkUser');
    }

    public function setPicturePathAttribute($value)
    {
        if($value == '')
        {
            $this->attributes['picture_path'] = 'default.png';
        }

    }
}
