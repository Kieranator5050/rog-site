<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationUser extends Model
{
    use HasFactory;
    protected $table = 'operation_user';

    public function operation()
    {
        $this->belongsTo(Operation::class);
    }

    public function players()
    {
        $this->belongsTo(User::class);
    }
}
