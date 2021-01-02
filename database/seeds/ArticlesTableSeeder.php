<?php

use App\Article;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        for ($i = 1 ; $i <= 20 ; $i++ ){
//
//            DB::table('users')->insert([
//                'name' => Str::random(10),
//                'email' => Str::random(10).'@gmail.com',
//                'password' => Hash::make('password'),
//            ]);
//        }
//        factory(Article::class,10)->create()->each(function($article){
//            for($i=0;$i<5;$i++){
//                $product = $user->products()->create(factory('App\products')->make()->toArray());
//                $product->categories()->attach([rand(1,3)]);
//            }
//        });

//        factory(User::class,2)->create()->each(function($user){
//            for($i=0;$i<5;$i++){
//                $article = $user->articles()->create(factory(Article::class)->make()->toArray());
//                $article->categories()->attach([rand(1,3)]);
//            }
//        });
//        DB::table('articles')->insert([
//               'image' =>,

        Article::truncate();
//        factory(Article::class,10)->create();

        factory(Article::class, 5)->create()->each(function ($article) {
            $article->categories()->save(factory(App\Category::class)->make());
        });
    }
}
