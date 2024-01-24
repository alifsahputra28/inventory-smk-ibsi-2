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
    protected $with = ['dataComputer', 'laboratoryRoom'];
    /**
     * Get the dataComputer associated with the ComputerInformation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function dataComputer(): BelongsTo
    {
        return $this->belongsTo(DataComputer::class);
    }

    /**
     * Get the laboratoryRoom that owns the ComputerInformation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function laboratoryRoom()
    {
        return $this->belongsTo(LaboratoryRoom::class, 'laboratory_room_id');
    }
}
