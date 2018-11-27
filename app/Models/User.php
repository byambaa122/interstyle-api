<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Traits\Searchable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'avatar', 'password', 'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean',
    ];
    
    /**
     * The attributes that are searchable.
     *
     * @var array
     */
	protected $searchable = [
        'name', 'email',
    ];

    /**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules($id = null)
	{
		return [
            'name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'avatar' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
        ];
	}
}
