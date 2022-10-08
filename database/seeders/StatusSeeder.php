<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'code' => '0',
            'title' => 'Cancelled',
            'color' => 'red'
        ]);
        Status::create([
            'code' => '1',
            'title' => 'Pending',
            'color' => 'gray'
        ]);
        Status::create([
            'code' => '2',
            'title' => 'Processing',
            'color' => 'teal'
        ]);
        Status::create([
            'code' => '3',
            'title' => 'Confirmed',
            'color' => 'blue'
        ]);
        Status::create([
            'code' => '4',
            'title' => 'Delivered',
            'color' => 'green'
        ]);
    }
}
