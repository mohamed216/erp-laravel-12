<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@erp.com',
            'password' => Hash::make('password'),
            'role' => 'Admin',
        ]);

        DB::table('customers')->insert([
            ['name' => 'John Doe', 'email' => 'john@test.com', 'phone' => '1234567890'],
            ['name' => 'Ahmed Ali', 'email' => 'ahmed@test.com', 'phone' => '0555123456'],
        ]);

        DB::table('products')->insert([
            ['name' => 'Laptop', 'sku' => 'ELEC-001', 'price' => 999.99, 'cost_price' => 700.00],
            ['name' => 'Smartphone', 'sku' => 'ELEC-002', 'price' => 599.99, 'cost_price' => 400.00],
            ['name' => 'T-Shirt', 'sku' => 'CLTH-001', 'price' => 29.99, 'cost_price' => 15.00],
        ]);

        DB::table('inventories')->insert([
            ['product_id' => 1, 'stock_quantity' => 50],
            ['product_id' => 2, 'stock_quantity' => 100],
            ['product_id' => 3, 'stock_quantity' => 200],
        ]);
    }
}
