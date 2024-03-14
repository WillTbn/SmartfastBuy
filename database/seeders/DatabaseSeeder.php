<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleTableSeeder::class,
            UserTableSeeder::class,
            CondominiasTableSeeder::class,
            ContractCondominiasTableSeeder::class,
            AddressCondominiaTableSeeder::class,
            BlocksTableSeeder::class,
            ApartmentsTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            ProductBarcodeTableSeeder::class
        ]);
    }
}
