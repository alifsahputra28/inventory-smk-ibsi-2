<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataComputer extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'data_computers';

}
