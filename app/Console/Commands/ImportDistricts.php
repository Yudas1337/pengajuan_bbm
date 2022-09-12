<?php

namespace App\Console\Commands;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Console\Command;

class ImportDistricts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:districts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import district and village to the table';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $i = 1;
        $start_villages = 352501;
        $end_villages = 352518;
        $province_id = 35; // jawa timur
        $regency_id = 3525; // gresik

        $provinces = file_get_contents(base_path() . "/imports/provinces/data.json");

        $decodes = json_decode($provinces);
        foreach ($decodes as $decode) {
            Province::updateOrCreate(
                ['id' => $decode->id],
                [
                    'id' => $decode->id,
                    'name' => $decode->nama
                ]
            );
            echo "($i) data provinsi berhasil di import \n";
            $i++;
        }

        $regencies = file_get_contents(base_path() . "/imports/regencies/data.json");

        $decodes = json_decode($regencies);

        foreach ($decodes as $decode) {
            Regency::updateOrCreate(
                ['id' => $decode->id],
                [
                    'id' => $decode->id,
                    'province_id' => $province_id,
                    'name' => $decode->nama
                ]
            );
            echo "($i) data kabupaten berhasil di import \n";
            $i++;
        }

        $districts = file_get_contents(base_path() . "/imports/districts/data.json");

        $decodes = json_decode($districts);
        foreach ($decodes as $decode) {
            District::updateOrCreate(
                ['id' => $decode->id],
                [
                    'id' => $decode->id,
                    'regency_id' => $regency_id,
                    'name' => $decode->nama
                ]
            );
            echo "($i) data kecamatan berhasil di import \n";
            $i++;
        }

        for ($i = $start_villages; $i <= $end_villages; $i++) {
            $villages = file_get_contents(base_path() . "/imports/villages/$i.json");
            $decodes = json_decode($villages);
            foreach ($decodes as $decode) {
                Village::updateOrCreate(
                    ['id' => $decode->id],
                    [
                        'id' => $decode->id,
                        'district_id' => $i,
                        'name' => $decode->nama
                    ]
                );
                echo "($i) data kelurahan/desa berhasil di import \n";
            }

        }
    }
}
