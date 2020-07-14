<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralOption extends Model
{
    use SoftDeletes;
    protected $table = 'opciones_generales';

    public function recordStatus()
    {
        return $this->belongsTo('App\Models\RecordStatus', 'fkRecordStatus', 'pkRecordStatus');
    }
}
