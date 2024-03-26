<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Document::insert([
            ['name' => 'BVN', 'code' => 'bvn', 'type' => 'text'],
            ['name' => 'Identity Card', 'code' => 'id-card', 'type' => 'file'],
            ['name' => 'Utility Bill', 'code' => 'utility-bill', 'type' => 'file'],
            ['name' => 'CAC Document', 'code' => 'cac', 'type' => 'file'],
        ]);
    }
}
