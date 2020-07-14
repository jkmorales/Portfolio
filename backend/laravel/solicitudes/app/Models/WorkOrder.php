<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkOrder extends Model
{
    use SoftDeletes;
    protected $table = 'ordenes_de_trabajo';

    public function recordStatus()
    {
        return $this->belongsTo('App\Models\RecordStatus', 'fkRecordStatus', 'pkRecordStatus');
    }

    public function solicitudes()
    {
        return $this->hasMany('App\Models\Request', 'fkOt','pkOt');
    }
}
