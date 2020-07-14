<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitud extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'pkSolicitud';
    protected $table = 'solicitudes';

    protected $hidden = ['fkUser','fkFirma','fkOt','created_at','updated_at','deleted_at'];
    protected $fillable = ['monto','observaciones','fkUser','fkOt','fkRecordStatus'];

    public function firma()
    {
        return $this->hasOne('App\Models\Signature','fkFirma','pkFirma');
    }

    public function ot()
    {
        return $this->belongsTo('App\Models\WorkOrder','fkOt','pkOt');
    }

    public function recordStatus()
    {
        return $this->belongsTo('App\Models\RecordStatus', 'fkRecordStatus', 'pkRecordStatus');
    }

    public function user()
    {
        return $this->belongsTo('App\User','fkUser');
    }

}
