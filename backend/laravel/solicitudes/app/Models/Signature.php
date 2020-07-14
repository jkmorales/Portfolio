<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Signature extends Model
{
    use SoftDeletes;
    protected $table = 'firmas';

    public function recordStatus()
    {
        return $this->belongsTo('App\Models\RecordStatus', 'fkRecordStatus', 'pkRecordStatus');
    }

    public function solicitudes()
    {
        return $this->belongsTo('App\Models\Request', 'fkFirma','pkFirma');
    }
}
