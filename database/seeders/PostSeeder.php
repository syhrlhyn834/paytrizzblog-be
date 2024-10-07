<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            'title'      => 'Data Kesehatan',
            'slug'     => 'data-kesehatan',
            'category_id' => '1',
            'user_id' => '1',
            'content' => 'Isi berita dummy',
            'image' => 'https://datadummy.com',
            'description' => 'Description dummy',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
