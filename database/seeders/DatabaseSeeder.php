<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      
      $user = User::factory()->create([
        'name' => 'John Dear'
      ]);
      Post::factory(5)->create([
        'user_id' => $user->id
      ]);

    //   User::truncate();
    //   Category::truncate();
    //   Post::truncate();

    //   $user = User::factory()->create();

    //   $personal = Category::create([
    //     'name' => 'Personal',
    //     'slug' => 'personal',
    //   ]);

    //   $family = Category::create([
    //     'name' => 'Family',
    //     'slug' => 'family',
    //   ]);
      
    //   $work = Category::create([
    //     'name' => 'Work',
    //     'slug' => 'work',
    //   ]);

    //   Post::create([
    //     'user_id' => $user->id,
    //     'category_id' => $family->id,
    //     'title' => 'My Family Post',
    //     'slug' => 'my-family-post',
    //     'excerpt' => 'Lorem iosum dolar sit amer.',
    //     'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi iste non minima quisquam ex dolores, sequi dolorum odio impedit voluptas enim, explicabo ipsam nostrum illum. Dolore reiciendis quod molestiae rem?'
    //   ]);

    //   Post::create([
    //     'user_id' => $user->id,
    //     'category_id' => $work->id,
    //     'title' => 'My Work Post',
    //     'slug' => 'my-work-post',
    //     'excerpt' => 'Lorem iosum dolar sit amer.',
    //     'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi iste non minima quisquam ex dolores, sequi dolorum odio impedit voluptas enim, explicabo ipsam nostrum illum. Dolore reiciendis quod molestiae rem?'
    //   ]);
    }
}