<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Base extends Model
{
    use Searchable;

	/**
	 * The attributes that are searchable.
	 *
	 * @var array
	 */
    protected $searchable = [
        //
    ];
    
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            //
        ];
	}
}
