<?php

namespace VietnameseAdministrativeUnits\Commands;

use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;
use VietnameseAdministrativeUnits\Models\District;
use VietnameseAdministrativeUnits\Models\Province;
use VietnameseAdministrativeUnits\Models\Ward;

class ImportationCommand extends Command
{
    public $signature = 'vietnamese-administrative-units:import
                            {file? : The CSV file path, which is created by converting the Excel file that can be downloaded in its full version including provinces, districts, and wards from https://www.gso.gov.vn/phuong-phap-luan-thong-ke/danh-muc/don-vi-hanh-chinh/}
    ';

    public $description = 'Import Vietnamese administrative units csv file to database';

    protected array $cache = [
        'latestProvince' => null,
        'latestDistrict' => null,
    ];

    public function handle(): int
    {
        $filePath = $this->argument('file') ?? __DIR__.'/../../assets/vietnamese-administrative-units.csv';

        $this->components->info('Importing Vietnamese administrative units CSV file to database using file:');
        $this->components->info($filePath);

        $rows = SimpleExcelReader::create($filePath)
            ->getRows();

        $startedAt = now();

        $this->components->task('Inserting provinces, districts, and wards to database', function () use ($rows) {
            $rows->each(function (array $row) {
                [
                    'Tỉnh Thành Phố' => $provinceName,
                    'Mã TP' => $provinceCode,
                    'Quận Huyện' => $districtName,
                    'Mã QH' => $districtCode,
                    'Phường Xã' => $wardName,
                    'Mã PX' => $wardCode,
                ] = $row;

                $province = $this->getOrCreateAndTouchProvince($provinceName, $provinceCode);
                $district = $this->getOrCreateAndTouchDistrict($province, $districtName, $districtCode);
                $ward = $this->getOrCreateAndTouchWard($district, $wardName, $wardCode);
            });
        });

        $this->components->task('Soft deleting provinces that are not existed in the CSV file', function () use ($startedAt) {
            Province::withTrashed()->where('updated_at', '<', $startedAt)->chunk(100, function ($provinces) {
                $provinces->each->delete();
            });
        });

        $this->components->task('Soft deleting districts that are not existed in the CSV file', function () use ($startedAt) {
            District::withTrashed()->where('updated_at', '<', $startedAt)->chunk(100, function ($districts) {
                $districts->each->delete();
            });
        });

        $this->components->task('Soft deleting wards that are not existed in the CSV file', function () use ($startedAt) {
            Ward::withTrashed()->where('updated_at', '<', $startedAt)->chunk(100, function ($wards) {
                $wards->each->delete();
            });
        });

        return self::SUCCESS;
    }

    protected function getOrCreateAndTouchProvince(string $provinceName, string $provinceCode): Province
    {
        if ($this->cache['latestProvince'] && $this->cache['latestProvince']->code == $provinceCode) {
            return $this->cache['latestProvince'];
        }

        /** @var ?Province */
        $province = Province::withTrashed()->where('code', $provinceCode)->first();

        if (! $province) {
            /** @var Province */
            $province = Province::create([
                'name' => $provinceName,
                'code' => $provinceCode,
            ]);
        }

        if ($province->trashed()) {
            $province->restore();
        }

        $province->touch();
        $this->cache['latestProvince'] = $province;

        return $province;
    }

    protected function getOrCreateAndTouchDistrict(Province $province, string $districtName, string $districtCode): District
    {
        if ($this->cache['latestDistrict'] && $this->cache['latestDistrict']->code == $districtCode) {
            return $this->cache['latestDistrict'];
        }

        /** @var ?District */
        $district = District::withTrashed()->where('code', $districtCode)->first();

        if (! $district) {
            /** @var District */
            $district = District::create([
                'name' => $districtName,
                'code' => $districtCode,
                'province_id' => $province->id,
            ]);
        }

        if ($district->trashed()) {
            $district->restore();
        }

        $district->touch();
        $this->cache['latestDistrict'] = $district;

        return $district;
    }

    protected function getOrCreateAndTouchWard(District $district, string $wardName, string $wardCode): Ward
    {
        /** @var ?Ward */
        $ward = Ward::withTrashed()->where('code', $wardCode)->first();

        if (! $ward) {
            /** @var Ward */
            $ward = Ward::create([
                'name' => $wardName,
                'code' => $wardCode,
                'district_id' => $district->id,
            ]);
        }

        if ($ward->trashed()) {
            $ward->restore();
        }

        $ward->touch();

        return $ward;
    }
}
