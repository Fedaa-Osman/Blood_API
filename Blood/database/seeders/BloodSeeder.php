<?php

namespace Database\Seeders;

use App\Models\BloodType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\type;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ["A+","A-","B+","B-","AB+","AB-","O+","O-"];

        foreach ($types as $type) {
            BloodType::create([
                "type" => $type,
                "amount" => 0,
            ]);
        }
    }
}
