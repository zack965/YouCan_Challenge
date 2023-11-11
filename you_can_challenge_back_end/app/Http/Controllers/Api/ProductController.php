<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductListResource;
use App\IRepository\IProductRepository;


class ProductController extends Controller
{
    //
    private IProductRepository $iProductRepository;
    public function __construct(IProductRepository $iProductRepository)
    {
        $this->iProductRepository = $iProductRepository;
    }
    public function ShowProducts(){
        $products =$this->iProductRepository->ShowProducts();
        return response()->json(ProductListResource::collection($products));
    }
    public function ShowAllCategories(){

        return response()->json($this->iProductRepository->ShowCategories());
    }
    public function CreateProduct(CreateProductRequest $createProductRequest){
        $product = $this->iProductRepository->CreateProduct($createProductRequest);
        return response()->json($product);
    }
}
