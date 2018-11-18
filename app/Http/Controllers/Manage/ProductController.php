<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends BaseController
{
	public function __construct(Product $product)
    {
		$this->model = $product;
	}

	protected function requestParams($request)
	{
		$data = $request->only(['code', 'description', 'images', 'price']);
        $params = array_merge($data, [
            'product_category_id' => $request->input('productCategory.id'),
        ]);

        return $params;
	}
}
