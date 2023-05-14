<?php

namespace VietnameseAdministrativeUnits\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $district_id
 * @property District $district
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 */
class Ward extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'district_id',
    ];

    public function getTable()
    {
        return config('vietnamese-administrative-units.ward.table', parent::getTable());
    }

    public function district()
    {
        // @phpstan-ignore-next-line
        return $this->belongsTo(config('vietnamese-administrative-units.district.model', District::class))->withTrashed();
    }
}
