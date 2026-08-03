<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'category_name');
        $sellers = Seller::pluck('id', 'seller_name');
        
       $products = [

    // ===============================
    // Maju Jaya Computer
    // ===============================

    [
        'seller_id' => $sellers['Maju Jaya Computer'],
        'category_id' => $categories['Mouse'],
        'product_name' => 'Logitech M185 Wireless Mouse',
        'description' => 'Mouse wireless Logitech M185 dengan koneksi 2.4GHz.',
        'price' => 145000,
        'stock' => 30,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Maju Jaya Computer'],
        'category_id' => $categories['Mouse'],
        'product_name' => 'Logitech B100 Optical Mouse',
        'description' => 'Mouse USB dengan desain ergonomis untuk penggunaan harian.',
        'price' => 85000,
        'stock' => 40,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Maju Jaya Computer'],
        'category_id' => $categories['Keyboard'],
        'product_name' => 'Logitech K120 Keyboard',
        'description' => 'Keyboard USB full-size dengan tombol nyaman.',
        'price' => 165000,
        'stock' => 25,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Maju Jaya Computer'],
        'category_id' => $categories['Keyboard'],
        'product_name' => 'Fantech MK852 Mechanical Keyboard',
        'description' => 'Keyboard mechanical dengan RGB backlight.',
        'price' => 485000,
        'stock' => 18,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Maju Jaya Computer'],
        'category_id' => $categories['SSD'],
        'product_name' => 'Kingston SSD A400 240GB',
        'description' => 'SSD SATA Kingston A400 kapasitas 240GB.',
        'price' => 420000,
        'stock' => 20,
        'image' => null,
    ],

    // ===============================
    // Berkah Elektronik
    // ===============================

    [
        'seller_id' => $sellers['Berkah Elektronik'],
        'category_id' => $categories['Mouse'],
        'product_name' => 'Rexus Daxa Air Mouse',
        'description' => 'Mouse gaming wireless ringan.',
        'price' => 275000,
        'stock' => 22,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Berkah Elektronik'],
        'category_id' => $categories['Mouse'],
        'product_name' => 'Fantech VX7 Crypto Mouse',
        'description' => 'Mouse gaming RGB dengan sensor presisi.',
        'price' => 185000,
        'stock' => 28,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Berkah Elektronik'],
        'category_id' => $categories['Keyboard'],
        'product_name' => 'Digital Alliance Meca Warrior',
        'description' => 'Keyboard mechanical dengan RGB.',
        'price' => 525000,
        'stock' => 15,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Berkah Elektronik'],
        'category_id' => $categories['Keyboard'],
        'product_name' => 'Rexus Legionare MX5.1',
        'description' => 'Mechanical keyboard untuk gaming.',
        'price' => 615000,
        'stock' => 12,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Berkah Elektronik'],
        'category_id' => $categories['SSD'],
        'product_name' => 'V-Gen SSD 256GB',
        'description' => 'SSD SATA 256GB.',
        'price' => 395000,
        'stock' => 20,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Berkah Elektronik'],
        'category_id' => $categories['Flashdisk'],
        'product_name' => 'HP Flashdisk 32GB',
        'description' => 'Flashdisk USB 3.0.',
        'price' => 75000,
        'stock' => 35,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Berkah Elektronik'],
        'category_id' => $categories['Webcam'],
        'product_name' => 'Logitech C310 HD Webcam',
        'description' => 'Webcam HD untuk meeting online.',
        'price' => 425000,
        'stock' => 10,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Berkah Elektronik'],
        'category_id' => $categories['Speaker'],
        'product_name' => 'Simbadda CST 800N',
        'description' => 'Speaker multimedia.',
        'price' => 265000,
        'stock' => 18,
        'image' => null,
    ],

    // ===============================
    // Digital Tech Store
    // ===============================

    [
        'seller_id' => $sellers['Digital Tech Store'],
        'category_id' => $categories['Flashdisk'],
        'product_name' => 'Sandisk Cruzer Blade 64GB',
        'description' => 'Flashdisk USB 3.0 kapasitas 64GB.',
        'price' => 98000,
        'stock' => 45,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Digital Tech Store'],
        'category_id' => $categories['Webcam'],
        'product_name' => 'Logitech C270 Webcam',
        'description' => 'Webcam HD 720p untuk meeting online.',
        'price' => 345000,
        'stock' => 15,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Digital Tech Store'],
        'category_id' => $categories['Speaker'],
        'product_name' => 'Robot RS200 Speaker',
        'description' => 'Speaker multimedia dengan suara jernih.',
        'price' => 220000,
        'stock' => 20,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Digital Tech Store'],
        'category_id' => $categories['Mouse'],
        'product_name' => 'Logitech G102 Lightsync',
        'description' => 'Mouse gaming RGB.',
        'price' => 255000,
        'stock' => 25,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Digital Tech Store'],
        'category_id' => $categories['Mouse'],
        'product_name' => 'Razer DeathAdder Essential',
        'description' => 'Mouse gaming ergonomis.',
        'price' => 345000,
        'stock' => 18,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Digital Tech Store'],
        'category_id' => $categories['Keyboard'],
        'product_name' => 'Logitech G213 Prodigy',
        'description' => 'Gaming keyboard RGB.',
        'price' => 675000,
        'stock' => 14,
        'image' => null,
    ],

    [
        'seller_id' => $sellers['Digital Tech Store'],
        'category_id' => $categories['Keyboard'],
        'product_name' => 'Fantech MAXFIT61',
        'description' => 'Mechanical keyboard 60%.',
        'price' => 725000,
        'stock' => 11,
        'image' => null,
    ],

    // ===============================
// Digital Tech Store
// ===============================

[
    'seller_id' => $sellers['Digital Tech Store'],
    'category_id' => $categories['SSD'],
    'product_name' => 'Samsung SSD 870 EVO 500GB',
    'description' => 'SSD SATA Samsung 870 EVO berkapasitas 500GB.',
    'price' => 825000,
    'stock' => 12,
    'image' => null,
],

[
    'seller_id' => $sellers['Digital Tech Store'],
    'category_id' => $categories['Flashdisk'],
    'product_name' => 'Kingston DataTraveler Exodia 128GB',
    'description' => 'Flashdisk USB 3.2 berkapasitas 128GB.',
    'price' => 185000,
    'stock' => 28,
    'image' => null,
],

[
    'seller_id' => $sellers['Digital Tech Store'],
    'category_id' => $categories['Webcam'],
    'product_name' => 'A4Tech PK-910H Webcam',
    'description' => 'Webcam Full HD untuk meeting dan streaming.',
    'price' => 385000,
    'stock' => 16,
    'image' => null,
],

// ===============================
// Nusantara Komputer
// ===============================

[
    'seller_id' => $sellers['Nusantara Komputer'],
    'category_id' => $categories['Mouse'],
    'product_name' => 'Asus WT300 Wireless Mouse',
    'description' => 'Mouse wireless Asus dengan desain ergonomis.',
    'price' => 215000,
    'stock' => 20,
    'image' => null,
],

[
    'seller_id' => $sellers['Nusantara Komputer'],
    'category_id' => $categories['Mouse'],
    'product_name' => 'Acer USB Optical Mouse',
    'description' => 'Mouse USB untuk penggunaan harian.',
    'price' => 95000,
    'stock' => 35,
    'image' => null,
],

[
    'seller_id' => $sellers['Nusantara Komputer'],
    'category_id' => $categories['Keyboard'],
    'product_name' => 'Acer Keyboard USB',
    'description' => 'Keyboard USB full-size dengan tombol nyaman.',
    'price' => 175000,
    'stock' => 24,
    'image' => null,
],

[
    'seller_id' => $sellers['Nusantara Komputer'],
    'category_id' => $categories['Keyboard'],
    'product_name' => 'Asus Keyboard USB',
    'description' => 'Keyboard USB untuk kebutuhan kantor dan belajar.',
    'price' => 185000,
    'stock' => 20,
    'image' => null,
],

[
    'seller_id' => $sellers['Nusantara Komputer'],
    'category_id' => $categories['SSD'],
    'product_name' => 'WD Green SSD 240GB',
    'description' => 'SSD WD Green SATA 240GB.',
    'price' => 445000,
    'stock' => 18,
    'image' => null,
],

[
    'seller_id' => $sellers['Nusantara Komputer'],
    'category_id' => $categories['Flashdisk'],
    'product_name' => 'Toshiba Hayabusa 64GB',
    'description' => 'Flashdisk USB berkapasitas 64GB.',
    'price' => 99000,
    'stock' => 40,
    'image' => null,
],

[
    'seller_id' => $sellers['Nusantara Komputer'],
    'category_id' => $categories['Speaker'],
    'product_name' => 'Robot RB120 Speaker',
    'description' => 'Speaker multimedia dengan suara jernih.',
    'price' => 245000,
    'stock' => 15,
    'image' => null,
],

// ===============================
// Nusantara Komputer
// ===============================

[
    'seller_id' => $sellers['Nusantara Komputer'],
    'category_id' => $categories['Webcam'],
    'product_name' => 'Xiaomi Mi Webcam Full HD',
    'description' => 'Webcam Full HD dengan kualitas gambar tajam.',
    'price' => 395000,
    'stock' => 14,
    'image' => null,
],

[
    'seller_id' => $sellers['Nusantara Komputer'],
    'category_id' => $categories['Monitor'],
    'product_name' => 'AOC 22B2HN 22 Inch Monitor',
    'description' => 'Monitor Full HD 22 inci dengan panel VA.',
    'price' => 1650000,
    'stock' => 8,
    'image' => null,
],

// ===============================
// Sentra Aksesori
// ===============================

[
    'seller_id' => $sellers['Sentra Aksesori'],
    'category_id' => $categories['Mouse'],
    'product_name' => 'HP Wireless Mouse S1000',
    'description' => 'Mouse wireless HP dengan desain ergonomis.',
    'price' => 175000,
    'stock' => 30,
    'image' => null,
],

[
    'seller_id' => $sellers['Sentra Aksesori'],
    'category_id' => $categories['Mouse'],
    'product_name' => 'Dell MS116 Optical Mouse',
    'description' => 'Mouse optik USB Dell untuk penggunaan harian.',
    'price' => 95000,
    'stock' => 35,
    'image' => null,
],

[
    'seller_id' => $sellers['Sentra Aksesori'],
    'category_id' => $categories['Keyboard'],
    'product_name' => 'Dell KB216 Keyboard',
    'description' => 'Keyboard USB Dell full-size.',
    'price' => 195000,
    'stock' => 20,
    'image' => null,
],

[
    'seller_id' => $sellers['Sentra Aksesori'],
    'category_id' => $categories['Keyboard'],
    'product_name' => 'HP Keyboard K1500',
    'description' => 'Keyboard USB HP untuk bekerja dan belajar.',
    'price' => 185000,
    'stock' => 24,
    'image' => null,
],

[
    'seller_id' => $sellers['Sentra Aksesori'],
    'category_id' => $categories['SSD'],
    'product_name' => 'Team GX2 SSD 256GB',
    'description' => 'SSD Team GX2 SATA 256GB.',
    'price' => 425000,
    'stock' => 18,
    'image' => null,
],

[
    'seller_id' => $sellers['Sentra Aksesori'],
    'category_id' => $categories['Flashdisk'],
    'product_name' => 'Lexar JumpDrive 64GB',
    'description' => 'Flashdisk USB 3.0 berkapasitas 64GB.',
    'price' => 99000,
    'stock' => 32,
    'image' => null,
],

[
    'seller_id' => $sellers['Sentra Aksesori'],
    'category_id' => $categories['Webcam'],
    'product_name' => 'Logitech BRIO 4K Webcam',
    'description' => 'Webcam premium dengan resolusi 4K.',
    'price' => 2150000,
    'stock' => 5,
    'image' => null,
],

[
    'seller_id' => $sellers['Sentra Aksesori'],
    'category_id' => $categories['Speaker'],
    'product_name' => 'Sony SRS-XB13 Bluetooth Speaker',
    'description' => 'Speaker Bluetooth portabel dengan Extra Bass.',
    'price' => 785000,
    'stock' => 12,
    'image' => null,
],

// ===============================
// Maju Jaya Computer
// ===============================

[
    'seller_id' => $sellers['Maju Jaya Computer'],
    'category_id' => $categories['Headset'],
    'product_name' => 'Logitech H111 Stereo Headset',
    'description' => 'Headset stereo untuk meeting dan belajar.',
    'price' => 225000,
    'stock' => 18,
    'image' => null,
],

[
    'seller_id' => $sellers['Maju Jaya Computer'],
    'category_id' => $categories['Monitor'],
    'product_name' => 'LG 24MP400 Monitor 24 Inch',
    'description' => 'Monitor IPS Full HD 24 inci.',
    'price' => 1899000,
    'stock' => 10,
    'image' => null,
],

// ===============================
// Berkah Elektronik
// ===============================

[
    'seller_id' => $sellers['Berkah Elektronik'],
    'category_id' => $categories['Headset'],
    'product_name' => 'Fantech HG11 Captain 7.1',
    'description' => 'Gaming headset dengan surround virtual 7.1.',
    'price' => 395000,
    'stock' => 15,
    'image' => null,
],

[
    'seller_id' => $sellers['Berkah Elektronik'],
    'category_id' => $categories['Monitor'],
    'product_name' => 'MSI PRO MP223 Monitor',
    'description' => 'Monitor Full HD 22 inci.',
    'price' => 1725000,
    'stock' => 8,
    'image' => null,
],

// ===============================
// Digital Tech Store
// ===============================

[
    'seller_id' => $sellers['Digital Tech Store'],
    'category_id' => $categories['Headset'],
    'product_name' => 'Razer BlackShark V2 X',
    'description' => 'Gaming headset dengan kualitas suara jernih.',
    'price' => 695000,
    'stock' => 10,
    'image' => null,
],

[
    'seller_id' => $sellers['Digital Tech Store'],
    'category_id' => $categories['Monitor'],
    'product_name' => 'Samsung Odyssey G3 24 Inch',
    'description' => 'Gaming monitor Full HD 144Hz.',
    'price' => 2699000,
    'stock' => 6,
    'image' => null,
],

// ===============================
// Nusantara Komputer
// ===============================

[
    'seller_id' => $sellers['Nusantara Komputer'],
    'category_id' => $categories['Headset'],
    'product_name' => 'A4Tech HS19 Headset',
    'description' => 'Headset stereo ringan untuk penggunaan harian.',
    'price' => 175000,
    'stock' => 20,
    'image' => null,
],

// ===============================
// Sentra Aksesori
// ===============================

[
    'seller_id' => $sellers['Sentra Aksesori'],
    'category_id' => $categories['Headset'],
    'product_name' => 'Sony MDR-ZX110 Headset',
    'description' => 'Headset ringan dengan suara seimbang.',
    'price' => 245000,
    'stock' => 18,
    'image' => null,
],

// ===============================
// Nusantara Komputer
// ===============================

[
    'seller_id' => $sellers['Nusantara Komputer'],
    'category_id' => $categories['Monitor'],
    'product_name' => 'ViewSonic VA2432-H 24 Inch Monitor',
    'description' => 'Monitor IPS Full HD 24 inci dengan desain bezel tipis.',
    'price' => 1799000,
    'stock' => 9,
    'image' => null,
],

// ===============================
// Sentra Aksesori
// ===============================

[
    'seller_id' => $sellers['Sentra Aksesori'],
    'category_id' => $categories['Monitor'],
    'product_name' => 'Philips 241V8 Monitor 24 Inch',
    'description' => 'Monitor Full HD 24 inci dengan panel VA dan teknologi LowBlue Mode.',
    'price' => 1849000,
    'stock' => 8,
    'image' => null,
],

];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
    