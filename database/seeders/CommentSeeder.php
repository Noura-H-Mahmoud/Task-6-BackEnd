<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create([
            'body'=>'comment from seeder',
            'post_id'=>'1',
            'user_id'=>'1'
        ]);
        Comment::create([
            'body'=>'comment from seeder',
            'post_id'=>'2',
            'user_id'=>'1'
        ]);
        Comment::create([
            'body'=>'comment from seeder',
            'post_id'=>'3',
            'user_id'=>'1'
        ]);
    }
}
