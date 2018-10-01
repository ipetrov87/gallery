<?php

use Illuminate\Database\Seeder;

class PicturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();
        $tags = \App\Tag::all();

        for ($i=0; $i < 100; $i++) { 
            $picture = factory(App\Picture::class)->create([
                'user_id' => $users->random()->id,
            ]);
            $picture->tags()->attach($tags->random(rand(1,5)));
        }
    }
}
