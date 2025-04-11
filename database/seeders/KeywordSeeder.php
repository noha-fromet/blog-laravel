<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Keyword;

class KeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Keyword::create(['name' => 'écologie']);
        Keyword::create(['name' => 'innovation']);
        Keyword::create(['name' => 'recette']);
    }
}
