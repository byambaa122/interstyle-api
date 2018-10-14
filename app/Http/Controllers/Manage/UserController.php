<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\User;

class UserController extends BaseController
{
    public function __construct(User $user)
    {
		$this->model = $user;
	}
}
