<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupportingDeviceInformation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['dataSupportingDevice', 'laboratoryRoom'];
    /**
     * Get the supportingDevice that owns the SupportingDeviceInformation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dataSupportingDevice(): BelongsTo
    {
        return $this->belongsTo(DataSupportingDevice::class);
    }

       /**
     * Get the laboratoryRoom that owns the ComputerInformation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function laboratoryRoom():BelongsTo
    {
        return $this->belongsTo(LaboratoryRoom::class, 'laboratory_room_id');
    }
}
