<?php

use App\Category;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(User::class, 4)->create()->each(function ($user) {
		    factory(Category::class, 3)->create()->each(function ($category) use ($user) {
		        factory(Post::class, 5)->create([
			        'category_id' => $category->id,
			        'user_id' => $user->id
		        ]);
		    });
		});
    }
}
