<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSupportingDevice extends Model
{
    use HasFactory, HasImage;
    protected $guarded = [];
}
