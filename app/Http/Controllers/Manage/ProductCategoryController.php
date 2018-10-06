<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends BaseController
{
	public function __construct(ProductCategory $productCategory)
    {
		$this->model = $productCategory;
	}
}
