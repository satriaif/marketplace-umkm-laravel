<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seller;

class SellerSeeder extends Seeder
{
    public function run(): void
    {
        Seller::insert([

            [
                'seller_name' => 'Maju Jaya Computer',
                'owner_name' => 'Budi Santoso',
                'phone' => '081234567891',
                'address' => 'Bekasi',
                'description' => 'Spesialis komputer dan aksesoris.'
            ],

            [
                'seller_name' => 'Berkah Elektronik',
                'owner_name' => 'Andi Pratama',
                'phone' => '081234567892',
                'address' => 'Jakarta',
                'description' => 'Menjual berbagai perangkat elektronik.'
            ],

            [
                'seller_name' => 'Digital Tech Store',
                'owner_name' => 'Rina Putri',
                'phone' => '081234567893',
                'address' => 'Depok',
                'description' => 'Laptop dan gadget berkualitas.'
            ],

            [
                'seller_name' => 'Nusantara Komputer',
                'owner_name' => 'Dedi Kurniawan',
                'phone' => '081234567894',
                'address' => 'Bandung',
                'description' => 'Perangkat komputer untuk UMKM.'
            ],

            [
                'seller_name' => 'Sentra Aksesori',
                'owner_name' => 'Siti Aminah',
                'phone' => '081234567895',
                'address' => 'Bogor',
                'description' => 'Aksesoris komputer dan gadget.'
            ],

        ]);
    }
}