<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title'=>'title 1',
            'body'=>'body from seeder',
            'category_id'=>'1',
            'user_id'=>'1'
        ]);
        Post::create([
            'title'=>'title 2',
            'body'=>'body from seeder',
            'category_id'=>'2',
            'user_id'=>'1'
        ]);
        Post::create([
            'title'=>'title 3',
            'body'=>'body from seeder',
            'category_id'=>'3',
            'user_id'=>'1'
        ]);
    }
}
