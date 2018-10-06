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
		$params = $request->only(['code', 'description', 'images', 'material', 'price']);
        $params = array_merge($data, [
            'product_category_id' => $request->input('productCategory.id'),
        ]);

        return snakeCaseKeys($params);
	}
}
