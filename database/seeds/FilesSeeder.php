<?php

use Illuminate\Database\Seeder;

class FilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $date = new DateTime();
        DB::table('files')->insert([
            'id' => 1,
            'name' => 'Nombre del archivo',
            'size' => 'Tamaño del archivo',
            'ext' => 'Extension del archivo',
            'upload_date' => $date,
            'direction' => 'Direccion del archivo'

        ]);
    }
}
