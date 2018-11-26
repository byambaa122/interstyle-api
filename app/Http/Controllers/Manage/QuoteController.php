<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Models\Quote;

class QuoteController extends BaseController
{
	public function __construct(Quote $quote)
    {
		$this->model = $quote;
	}
}
