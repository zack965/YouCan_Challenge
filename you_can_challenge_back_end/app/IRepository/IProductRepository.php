<?php


namespace App\IRepository;

use App\Http\Requests\CreateProductRequest;

interface IProductRepository {
    public function ShowProducts();
    public function ShowCategories();
    public function CreateProduct(CreateProductRequest $createProductRequest);
}
