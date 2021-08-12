<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('posts')->insert([
            ['title'     => 'Post 1',
            'user_id'   => 1,
            'content'   => 'Post content 1' 
            ],
            ['title'     => 'Post 2',
             'user_id'   => 2,
             'content'   => 'Post content 2'
            ],
            ['title'     => 'Post 3',
             'user_id'   => 3,
             'content'   => 'Post content 3' 
            ]
            ,
            ['title'     => 'Post 4',
             'user_id'   => 1,
             'content'   => 'Post content 4' 
            ]
        ]);
    }
}
