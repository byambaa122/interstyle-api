<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Models\MaterialCategory;

class MaterialCategoryController extends BaseController
{
	public function __construct(MaterialCategory $materialCategory)
    {
		$this->model = $materialCategory;
	}
}
