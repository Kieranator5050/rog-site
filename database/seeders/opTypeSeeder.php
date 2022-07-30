<?php

namespace Database\Seeders;

use App\Models\OperationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class opTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Create Types
        $types = collect();
        $types->push(OperationType::factory()->create([
            'name'=>'Contract'
        ]));
        $types->push(OperationType::factory()->create([
            'name'=>'Event'
        ]));
        $types->push(OperationType::factory()->create([
            'name'=>'Special'
        ]));
    }
}
