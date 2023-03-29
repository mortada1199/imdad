<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Truck extends Model  implements HasMedia
{
    use HasFactory, SoftDeletes, LogsActivity, InteractsWithMedia;
    protected $fillable = [
        'name', 'type', 'class', 'color', 'model', 'size', 'brand', 'created_by', 'status', 'plate_number','profile_id'
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class)->withTimestamps();
    }
}
