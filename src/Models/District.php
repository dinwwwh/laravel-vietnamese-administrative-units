<?php

namespace Dilee\VietnameseAdministrativeUnits\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property Province $province
 * @property Ward[]|\Illuminate\Database\Eloquent\Collection $wards
 */
class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];

    public function getTable()
    {
        return config('vietnamese-administrative-units.district.table', parent::getTable());
    }

    public function province()
    {
        return $this->belongsTo(config('vietnamese-administrative-units.province.model', Province::class));
    }

    public function wards()
    {
        return $this->hasMany(config('vietnamese-administrative-units.ward.model', Ward::class));
    }
}
