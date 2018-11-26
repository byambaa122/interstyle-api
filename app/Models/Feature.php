<?php

namespace App\Models;

use App\Traits\Searchable;

class Feature extends Base
{
    use Searchable;
    
	/**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'features';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'icon', 'title', 'body',
    ];

	/**
	 * The attributes that are searchable.
	 *
	 * @var array
	 */
	protected $searchable = [
        'title',
	];

    /**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ];
	}
}
