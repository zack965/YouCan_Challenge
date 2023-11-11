<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new product';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $productData = [
            'product_name' => $this->ask('Enter product_name: '),
            'product_desc' => $this->ask('Enter product description: '),
            'product_price' => $this->ask('Enter product price: '),
            'product_image' => $this->ask('Enter product image url: '),
        ];
        $validator = Validator::make($productData, [
            'product_name' => 'required|max:255',
            'product_desc' => 'required|max:255',
            'product_image' => 'required|max:255|url',
            'product_price' => 'required|numeric|min:0|max:1000',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            foreach ($errors->all() as $error) {
                $this->error($error);
            }

            return;
        }
        Product::create([
            'name' => $productData["product_name"],
            'description' =>  $productData["product_desc"],
            'price' =>  $productData["product_price"],
            'image' =>  $productData["product_image"],
        ]);



        $this->info('Product created successfully!  '.$productData["product_name"]);
    }
}
