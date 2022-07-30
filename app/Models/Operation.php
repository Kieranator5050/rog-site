<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $with = ['type'];
    protected $guarded =[];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['op_date'];

    public function type()
    {
        return $this->belongsTo(OperationType::class,'operation_type_id','id');
    }
}
