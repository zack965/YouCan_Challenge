<?php
namespace App\Repositories;

use App\Http\Requests\CreateProductRequest;
use App\IRepository\IProductRepository;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class ProductRepositories implements IProductRepository{
    public function ShowProducts(){
        $products = Product::skip(0)->take(10)->get();
        foreach ($products as $p) {
            $p->categories;
        }
        return $products;
    }
    public function ShowCategories(){
        return Category::all();
    }
    public function CreateProduct(CreateProductRequest $createProductRequest):Product{
        $file = $createProductRequest->file('image');
        $filename= time(). $file->getClientOriginalName();
        $path = Storage::disk('uploads')->putFileAs('', $file,$filename);


        $product = Product::create([
            "name" => $createProductRequest->name,
            "description" => $createProductRequest->description,
            "price" => $createProductRequest->price,
            "image" =>env("APP_URL")."/". $filename,
        ]);
        ProductCategory::create([
            "product_id"=> $product->product_id,
            "categorie_id"=> $createProductRequest->categorie,
        ]);
        return $product;
    }
}
