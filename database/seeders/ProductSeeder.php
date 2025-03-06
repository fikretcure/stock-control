<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Services\Elastic\CompanyElastic;
use App\Services\Elastic\ProductElastic;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $productNames = [
            'iPhone 15 Pro', 'Samsung Galaxy S23', 'Asus Gaming Laptop', 'Logitech Kablosuz Mouse',
            'SteelSeries Kulaklık', 'Apple MacBook Air', 'Xiaomi Akıllı Saat', 'Canon Profesyonel Kamera',
            'Philips AirFryer', 'Samsung 4K Televizyon', 'Sony Bluetooth Hoparlör', 'Bose Noise Cancelling Kulaklık',
            'PlayStation 5', 'Xbox Series X', 'Razer Mekanik Klavye', 'GoPro Hero 12', 'DJI Drone Mavic Air',
            'Dell UltraSharp Monitör', 'Huawei MatePad Pro', 'Amazon Kindle Paperwhite', 'OnePlus Nord CE 3',
            'HP LaserJet Yazıcı', 'Epson EcoTank Mürekkep Tanklı Yazıcı', 'Anker PowerCore Taşınabilir Şarj Cihazı',
            'JBL Flip 6 Bluetooth Hoparlör', 'Google Pixel 7', 'Lenovo Legion Oyun Bilgisayarı', 'MSI RTX 4070 Ekran Kartı',
            'Corsair Vengeance 32GB RAM', 'HyperX Cloud 2 Gaming Kulaklık', 'Apple AirPods Pro 2', 'Xiaomi Mi TV Stick',
            'Samsung Galaxy Watch 5', 'Sony Alpha A7 III Profesyonel Fotoğraf Makinesi', 'Nikon D750 DSLR Kamera',
            'LG UltraGear 144Hz Monitör', 'Asus ROG Strix Anakart', 'Cooler Master Sıvı Soğutma', 'NZXT Gaming Kasa',
            'Beats Studio 3 Kablosuz Kulaklık', 'Rode NT-USB Profesyonel Mikrofon', 'Shure SM7B Podcast Mikrofonu',
            'Beyerdynamic DT 990 Pro Stüdyo Kulaklık', 'Apple Magic Keyboard', 'Samsung T7 1TB SSD',
            'SanDisk 256GB USB Bellek', 'WD Black 2TB NVMe SSD', 'Logitech C920 HD Web Kamera',
            'TP-Link Archer AX73 WiFi 6 Router', 'Asus ZenBook OLED Laptop', 'Acer Nitro 5 Gaming Laptop',
            'Raspberry Pi 4 Model B', 'Intel Core i9 13900K İşlemci', 'AMD Ryzen 9 7950X İşlemci',
            'Logitech G Pro Wireless Mouse', 'BenQ Zowie XL2546K 240Hz Monitör', 'ViewSonic 32’’ 4K Monitör',
            'LG OLED C2 55" Smart TV', 'Xiaomi Redmi Buds 4 Pro', 'Sony WH-1000XM5 Kablosuz Kulaklık',
            'Marshall Emberton Taşınabilir Hoparlör', 'Bose SoundLink Revolve', 'Creative Pebble Plus 2.1 Hoparlör',
            'Xiaomi Smart Air Purifier 4', 'Dyson V15 Detect Kablosuz Süpürge', 'Rowenta Silence Force Süpürge',
            'Tefal Titanium Excellence Tava Seti', 'Fakir Kaave Türk Kahvesi Makinesi', 'Arçelik Gurme Çay Makinesi',
            'Vestel NF520 Derin Dondurucu', 'Siemens iQ500 Çamaşır Makinesi', 'Bosch Silence Plus Bulaşık Makinesi',
            'Samsung 8 Serisi Kurutma Makinesi', 'Beko 3 Kapılı Buzdolabı', 'Hisense 65" 4K Smart TV',
            'TCL 75" Mini LED TV', 'Apple iPad Air M1', 'Samsung Galaxy Tab S9 Ultra', 'Xiaomi Pad 5',
            'Microsoft Surface Pro 9', 'Oppo Reno 8', 'Realme GT Neo 3', 'Nothing Phone 2',
            'Casper Excalibur G911', 'Monster Tulpar T7', 'Gamepower Warcry Gaming Klavye',
            'SteelSeries Prime Mini Kablosuz Mouse', 'Razer BlackWidow V4 Mekanik Klavye',
            'Redragon Kumara K552 Mekanik Klavye', 'Cougar Blazer Gaming Kasa', 'Fractal Design Meshify 2 Compact',
            'Thermaltake Toughpower 850W PSU', 'EVGA GeForce RTX 4090', 'Sapphire Nitro+ RX 7900 XTX',
            'Cooler Master MM720 Gaming Mouse', 'Corsair K70 RGB Pro', 'Ducky One 2 Mini 60% Klavye',
            'Akaso Brave 7 Aksiyon Kamerası', 'Insta360 GO 2', 'Sony ZV-1 Vlog Kamera', 'Joby GorillaPod 3K Tripod',
            'Elgato Key Light Air Yayın Işığı', 'Logitech StreamCam Yayın Kamerası', 'AverMedia Live Gamer Portable 2 Plus',
            'Rode Wireless GO 2 Mikrofon', 'Sharkoon Skiller SGK3 Gaming Klavye', 'Thermaltake Toughram RGB 32GB RAM'
        ];

        foreach ($productNames as $index => $productName) {
            Product::create([
               'name' => $productName,
                'category_id' => Category::query()->inRandomOrder()->first()->id,
            ]);
        }

        Product::query()->get()->each(function ($product) {
            new ProductElastic()->store($product);
        });
    }
}
