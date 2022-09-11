<?php

namespace App\Console\Commands;

use App\Models\District;
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

        $districts = file_get_contents(base_path() . "/imports/districts/data.json");

        $decodes = json_decode($districts);
        foreach ($decodes as $decode) {
            District::updateOrCreate(
                ['id' => $decode->id],
                [
                    'id' => $decode->id,
                    'name' => $decode->nama
                ]
            );
            echo "($i) data berhasil  import \n";
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
                echo "($i) data berhasil  import \n";
            }

        }
    }
}
