<?php

namespace Dilee\VietnameseAdministrativeUnits\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property District[]|\Illuminate\Database\Eloquent\Collection $districts
 */
class Province extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
    ];

    public function getTable()
    {
        return config('vietnamese-administrative-units.province.table', parent::getTable());
    }

    public function districts()
    {
        return $this->hasMany(config('vietnamese-administrative-units.district.model', District::class));
    }
}
