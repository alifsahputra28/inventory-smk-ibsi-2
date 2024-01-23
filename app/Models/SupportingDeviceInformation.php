<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupportingDeviceInformation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['dataSupportingDevice'];
    /**
     * Get the supportingDevice that owns the SupportingDeviceInformation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dataSupportingDevice(): BelongsTo
    {
        return $this->belongsTo(DataSupportingDevice::class);
    }
}
