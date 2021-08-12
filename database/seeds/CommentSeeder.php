<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('comments')->insert([
            [
            'user_id'   => 1,
            'post_id'   => 1,
            'content'   => 'Comment 1 for post 1 from user 1' 
            ],
            [
            'user_id'   => 1,
            'post_id'   => 1,
            'content'   => 'Comment 2 for post 1 from user 1' 
            ],
            [
            'user_id'   => 1,
            'post_id'   => 2,
            'content'   => 'Comment 1 for post 2 from user 1' 
            ],
            [
            'user_id'   => 2,
            'post_id'   => 2,
            'content'   => 'Comment 1 for post 2 from user 2' 
            ],
        ]);
    }
}
