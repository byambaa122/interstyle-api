<?php

namespace App\Models;

use App\Traits\Searchable;

class Quote extends Base
{
    use Searchable;
    
	/**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'quotes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'body',
    ];

	/**
	 * The attributes that are searchable.
	 *
	 * @var array
	 */
	protected $searchable = [
		'name',
	];

    /**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'name' => 'required|string|max:255',
            'body' => 'required|string',
        ];
	}
}
