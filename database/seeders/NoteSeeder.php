<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('notes')->insert([
            [
                'user_id' => 1,
                'title' => 'Nakúpiť potraviny',
                'body' => 'Mlieko, chlieb, maslo, syr',
                'status' => 'published',
                'is_pinned' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'title' => 'Príprava na skúšku',
                'body' => 'Prejsť si Laravel routy a Query Builder',
                'status' => 'draft',
                'is_pinned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'title' => 'Projekt REST API',
                'body' => 'Dokončiť CRUD pre notes a categories',
                'status' => 'published',
                'is_pinned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'title' => 'Nápad na aplikáciu',
                'body' => 'Todo app s kategóriami',
                'status' => 'draft',
                'is_pinned' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'title' => 'Denný plán',
                'body' => 'Škola, tréning, učenie',
                'status' => 'published',
                'is_pinned' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
