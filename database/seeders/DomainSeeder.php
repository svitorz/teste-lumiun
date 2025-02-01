<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quantity = 50;

        for ($i = 0; $i < $quantity; $i++) {
            Domain::create([
                'name' => fake()->url(), // Nome do produto
                'category_id' => rand(1, 10), // ID da categoria (entre 1 e 10)
                'user_id' => User::inRandomOrder()->first()->id, // ID de um usuário aleatório
            ]);
        }
    }
}
