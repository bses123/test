<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts=[[
            'title'=>'Coin with two faces',
            'excerpt'=>'Story about the faces of the coins',
            'body'=>'Outstaning book',
            'image_path'=>'not included',
            'is_published'=>false,
            'min_to_read'=>2,
             
        ],
        [
            'title'=>'The Hidden Hindu',
            'excerpt'=>'Story about the mythology',
            'body'=>'Mythology mix with the reality',
            'image_path'=>'not included',
            'is_published'=>false,
            'min_to_read'=>3,
        ]
    ];

    foreach($posts as $key=>$value){
           Post::create($value);
    }

    }
}
