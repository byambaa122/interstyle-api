<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Models\Feature;

class FeatureController extends BaseController
{
	public function __construct(Feature $feature)
    {
		$this->model = $feature;
	}
}
