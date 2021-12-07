<?php

namespace Database\Seeders\DemoDataSeeders;

use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    /**
     * command to run it:
     * sail artisan db:seed \\Database\\Seeders\\DemoDataSeeders\\DemoDataSeeder
     */
    public function run()
    {
        $this->call(
            [
                TmoiseenkoSeeder::class,
//                TftpOSSeeder::class,
//                Pakycb84Seeder::class,
//                SkydescentSeeder::class,
            ]
        );
    }
}
