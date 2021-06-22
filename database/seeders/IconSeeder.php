<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class IconSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = base_path() .'/database/resources/icons.csv';
        $this->tablename = 'icons';
        $this->truncate = false;
        $this->timestamps = true;
        $this->delimiter = ',';
        $this->mapping = ['name', 'class_css'];
        $this->header = FALSE;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        //Clean table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table($this->tablename)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        //Run import
		parent::run();
    }
}
