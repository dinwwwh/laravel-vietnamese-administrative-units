<?php

namespace Dilee\VietnameseAdministrativeUnits\Commands;

use Illuminate\Console\Command;

class VietnameseAdministrativeUnitsCommand extends Command
{
    public $signature = 'vietnamese-administrative-units';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
