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

	protected function requestParams(Request $request)
	{
        $params = $request->all();
        $params = array_merge($params, [
            'product_category_id' => $request->input('productCategory.id'),
        ]);

        return $params;
	}
}
