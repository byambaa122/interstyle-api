<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends BaseController
{
    public function __construct(User $user)
    {
		$this->model = $user;
	}

    protected function requestParams(Request $request)
    {
        $data = $request->only(['name', 'email', 'avatar']);
       
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        return $data;
    }
}
