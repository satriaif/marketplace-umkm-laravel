<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class SyncProductImages extends Command
{
    protected $signature = 'products:sync-images';

    protected $description = 'Sinkronkan gambar produk berdasarkan nama produk';

    public function handle()
    {
        $folder = storage_path('app/public/products');

        $updated = 0;
        $skipped = 0;
        $notFound = 0;

        foreach (Product::all() as $product) {

            // Lewati jika produk sudah memiliki gambar
            if (!empty($product->image)) {

                $skipped++;

                $this->line("⏭ Lewati : {$product->product_name}");

                continue;
            }

            $extensions = ['jpg', 'jpeg', 'png', 'webp'];

            $found = false;

            foreach ($extensions as $ext) {

                $filename = $product->product_name . '.' . $ext;

                if (File::exists($folder . DIRECTORY_SEPARATOR . $filename)) {

                    $product->update([
                        'image' => $filename
                    ]);

                    $updated++;
                    $found = true;

                    $this->info("✔ {$filename}");

                    break;
                }
            }

            if (!$found) {

                $notFound++;

                $this->warn("✘ {$product->product_name}");

            }
        }

        $this->newLine();

        $this->info("======================================");
        $this->info("Sinkronisasi Gambar Selesai");
        $this->info("======================================");
        $this->info("Berhasil        : {$updated}");
        $this->line("Dilewati        : {$skipped}");
        $this->warn("Tidak ditemukan : {$notFound}");

        return Command::SUCCESS;
    }
}