<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();
        $this->call(AuthorSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PublisherSeeder::class);
        $this->call(BookSeeder::class);
    }
}
