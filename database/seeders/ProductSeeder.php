<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->product_code = "TXT100";
        $product->product_name = 'เทียน 100 เล่ม';
        $product->product_price = "120";
        $product->product_quantity = '100';
        $product->product_weight = '250gram';
        $product->product_detail ='เทียนคุณภาพดีอีกแล้วครับท่าน';
        $product->save();
    }
}
