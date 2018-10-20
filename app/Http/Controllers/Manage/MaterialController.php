<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends BaseController
{
	public function __construct(Material $material)
    {
		$this->model = $material;
	}

	protected function requestParams($request)
	{
		$data = $request->only(['code', 'description', 'images', 'material', 'price']);
        $params = array_merge($data, [
            'material_category_id' => $request->input('materialCategory.id'),
        ]);

        return $params;
	}
}
