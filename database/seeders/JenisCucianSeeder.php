<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisCucian;

class AddJenisCucianSeeder extends Seeder
{
    public function run()
    {
        $jenisCuci = [
            ['nama_jenis' => 'Express'], // cuci+kering+setrika
            ['nama_jenis' => 'Reguler'], // cuci basah
            ['nama_jenis' => 'cuci_kering'],
            ['nama_jenis' => 'setrika'],
        ];

        foreach ($jenisCuci as $jenis) {
            JenisCucian::create($jenis);
        }
    }
}
