<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'about_app' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere qui eius asperiores, animi adipisci quia eum beatae incidunt, laborum velit quibusdam debitis totam, et reiciendis ad? Commodi cupiditate velit vero? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum aspernatur est magnam, nesciunt culpa provident sit nobis molestias possimus? A optio dolores dolorum, odio nam est ducimus quis quisquam vero. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae modi veritatis iste provident quis consectetur animi soluta, rerum dicta dolorem suscipit facere quas, porro, pariatur tempora consequuntur ad accusamus. Voluptatem? Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere qui eius asperiores, animi adipisci quia eum beatae incidunt, laborum velit quibusdam debitis totam, et reiciendis ad? Commodi cupiditate velit vero? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum aspernatur est magnam, nesciunt culpa provident sit nobis molestias possimus? A optio dolores dolorum, odio nam est ducimus quis quisquam vero. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae modi veritatis iste provident quis consectetur animi soluta, rerum dicta dolorem suscipit facere quas, porro, pariatur tempora consequuntur ad accusamus. Voluptatem? Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere qui eius asperiores, animi adipisci quia eum beatae incidunt, laborum velit quibusdam debitis totam, et reiciendis ad? Commodi cupiditate velit vero? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum aspernatur est magnam, nesciunt culpa provident sit nobis molestias possimus? A optio dolores dolorum, odio nam est ducimus quis quisquam vero. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae modi veritatis iste provident quis consectetur animi soluta, rerum dicta dolorem suscipit facere quas, porro, pariatur tempora consequuntur ad accusamus. Voluptatem?',
            'about_us' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere qui eius asperiores, animi adipisci quia eum beatae incidunt, laborum velit quibusdam debitis totam, et reiciendis ad? Commodi cupiditate velit vero? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum aspernatur est magnam, nesciunt culpa provident sit nobis molestias possimus? A optio dolores dolorum, odio nam est ducimus quis quisquam vero. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae modi veritatis iste provident quis consectetur animi soluta, rerum dicta dolorem suscipit facere quas, porro, pariatur tempora consequuntur ad accusamus. Voluptatem? Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere qui eius asperiores, animi adipisci quia eum beatae incidunt, laborum velit quibusdam debitis totam, et reiciendis ad? Commodi cupiditate velit vero? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum aspernatur est magnam, nesciunt culpa provident sit nobis molestias possimus? A optio dolores dolorum, odio nam est ducimus quis quisquam vero. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae modi veritatis iste provident quis consectetur animi soluta, rerum dicta dolorem suscipit facere quas, porro, pariatur tempora consequuntur ad accusamus. Voluptatem? Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere qui eius asperiores, animi adipisci quia eum beatae incidunt, laborum velit quibusdam debitis totam, et reiciendis ad? Commodi cupiditate velit vero? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum aspernatur est magnam, nesciunt culpa provident sit nobis molestias possimus? A optio dolores dolorum, odio nam est ducimus quis quisquam vero. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae modi veritatis iste provident quis consectetur animi soluta, rerum dicta dolorem suscipit facere quas, porro, pariatur tempora consequuntur ad accusamus. Voluptatem?',
            'phone' => '01123003488',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
