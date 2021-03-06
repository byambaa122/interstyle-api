<?php

namespace App\Models;

class Material extends Base
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'materials';
  
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'images' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'description', 'images', 'price', 'is_special', 'material_category_id',
    ];

	/**
	 * The attributes that are searchable.
	 *
	 * @var array
	 */
	protected $searchable = [
		'code', 'description',
	];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'material_category_id',
    ];

	/**
	 * The attributes that are appends with relation.
	 *
	 * @var array
	 */
	protected $with = [
		'materialCategory',
	];

    /**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'code' => 'required|string|max:255',
            'description' => 'required|string',
            'images' => 'required|array',
            'price' => 'required|integer|digits_between:1,11',
            'isSpecial' => 'boolean',
            'materialCategory.id' => 'required|integer|digits_between:1,11',
        ];
	}

    /**
     * Get the materials for the material category.
     */
    public function materialCategory()
    {
        return $this->belongsTo('App\Models\MaterialCategory');
    }
}
