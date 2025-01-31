<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = collect(['Redes Sociais',
                    'E-commerce',
                    'Entretenimento',
                    'Educação',
                    'Notícias',
                    'Tecnologia',
                    'Finanças',
                    'Saúde',
                    'Adulto',
                    'Outros'
                ]);
        $items->map(function($value){
            $hasItem = Category::where('value',$value)->exists();
            if(!$hasItem){
                Category::create(['value' => $value]);
            }
        });
    }
}
