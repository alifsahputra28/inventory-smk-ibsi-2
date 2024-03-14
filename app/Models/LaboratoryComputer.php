<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaboratoryComputer extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['laboratoryRoom'];


    /**
     * Get the laboratoryRoom that owns the LaboratoryComputer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function laboratoryRoom(): BelongsTo
    {
        return $this->belongsTo(LaboratoryRoom::class);
    }
}
