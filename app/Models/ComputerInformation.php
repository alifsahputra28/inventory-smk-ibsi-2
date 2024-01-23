<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ComputerInformation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'computer_information';
    protected $with = ['dataComputer'];
    /**
     * Get the dataComputer associated with the ComputerInformation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function dataComputer(): BelongsTo
    {
        return $this->belongsTo(DataComputer::class);
    }
}
