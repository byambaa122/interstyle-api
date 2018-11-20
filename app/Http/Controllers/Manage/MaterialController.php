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

	protected function requestParams(Request $request)
	{
        $params = $request->all();
        $params = array_merge($params, [
            'material_category_id' => $request->input('materialCategory.id'),
        ]);

        return $params;
	}
}
