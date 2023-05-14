<?php

namespace VietnameseAdministrativeUnits\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $province_id
 * @property Province $province
 * @property Ward[]|\Illuminate\Database\Eloquent\Collection $wards
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 */
class District extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'province_id',
    ];

    public function getTable()
    {
        return config('vietnamese-administrative-units.district.table', parent::getTable());
    }

    public function province()
    {
        // @phpstan-ignore-next-line
        return $this->belongsTo(config('vietnamese-administrative-units.province.model', Province::class))->withTrashed();
    }

    public function wards()
    {
        return $this->hasMany(config('vietnamese-administrative-units.ward.model', Ward::class));
    }
}
