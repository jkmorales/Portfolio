<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecordStatus extends Model
{
    use SoftDeletes;
    protected $table = 'record_status';

    public function firmas()
    {
        return $this->hasMany('App\Models\Signature', 'fkRecordStatus', 'pkRecordStatus');
    }

    public function opcionesGenerales()
    {
        return $this->hasMany('App\Models\GeneralOption', 'fkRecordStatus', 'pkRecordStatus');
    }

    public function ots()
    {
        return $this->hasMany('App\Models\WorkOrder', 'fkRecordStatus', 'pkRecordStatus');
    }

    public function perfiles()
    {
        return $this->hasMany('App\Models\Profile', 'fkRecordStatus', 'pkRecordStatus');
    }

    public function solicitudes()
    {
        return $this->hasMany('App\Models\Request', 'fkRecordStatus', 'pkRecordStatus');
    }

    public function users()
    {
        return $this->hasMany('App\User', 'fkRecordStatus', 'pkRecordStatus');
    }
}
