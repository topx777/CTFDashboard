<?php

use App\Category;
use Illuminate\Database\Seeder;
use App\User;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'id' => 1,
            'name' => 'Criptografia',
            'description' => 'la criptología que se ocupa de las técnicas de cifrado o codificado destinadas a alterar las representaciones lingüísticas de ciertos mensajes con el fin de hacerlos ininteligibles a receptores no autorizados.'
        ]);
        DB::table('categories')->insert([
            'id' => 2,
            'name' => 'Esteganografia',
            'description' => 'La esteganografía trata el estudio y aplicación de técnicas que permiten ocultar mensajes u objetos, dentro de otros, llamados portadores, para ser enviados y de modo que no se perciba el hecho.'
        ]);
        DB::table('categories')->insert([
            'id' => 3,
            'name' => 'Forensia',
            'description' => 'Es la aplicación de técnicas y herramientas de hardware y software para determinar datos potenciales o relevantes.'
        ]);
        DB::table('categories')->insert([
            'id' => 4,
            'name' => 'Ingeniería inversa',
            'description' => 'es el proceso llevado a cabo con el objetivo de obtener información o un diseño a partir de un producto, con el fin de determinar cuáles son sus componentes y de qué manera interactúan entre sí y cuál fue el proceso de fabricación.'
        ]);
        DB::table('categories')->insert([
            'id' => 5,
            'name' => 'SQL injection',
            'description' => 'Es una vulnerabilidad que permite al atacante enviar o “inyectar” instrucciones SQL de forma maliciosa y malintencionada dentro del código SQL programado para la manipulación de bases de datos, de esta forma todos los datos almacenados estarían en peligro.'
        ]);
        factory(Category::class, 10)->create();
    }
}
