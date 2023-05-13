<?php

namespace Dilee\VietnameseAdministrativeUnits\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Dilee\VietnameseAdministrativeUnits\VietnameseAdministrativeUnits
 */
class VietnameseAdministrativeUnits extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Dilee\VietnameseAdministrativeUnits\VietnameseAdministrativeUnits::class;
    }
}
