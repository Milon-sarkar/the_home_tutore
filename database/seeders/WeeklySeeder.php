<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeeklySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = array(
            array('id' => '1','name' => 'একদিন'),
            array('id' => '2','name' => 'দুইদিন'),
            array('id' => '3','name' => 'তিনদিন'),
            array('id' => '4','name' => 'চারদিন'),
            array('id' => '5','name' => 'পাঁচদিন'),
            array('id' => '6','name' => 'ছয়দিন'),
            array('id' => '7','name' => 'সাতদিন'),
        );

        DB::table('weeklies')->insert($divisions);

    }
}
