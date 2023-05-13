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
class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];

    public function getTable()
    {
        return config('vietnamese-administrative-units.ward.table', parent::getTable());
    }

    public function district()
    {
        return $this->belongsTo(config('vietnamese-administrative-units.district.model', District::class));
    }
}
