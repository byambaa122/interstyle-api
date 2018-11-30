<?php

namespace App\Models;

class Product extends Base
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'products';
  
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isSpecial' => 'boolean',
        'images' => 'array',
        'size' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'description', 'images', 'measure', 'price', 'is_special', 'product_category_id',
    ];

	/**
	 * The attributes that are searchable.
	 *
	 * @var array
	 */
	protected $searchable = [
		'code', 'description', 'measure',
	];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'product_category_id',
    ];

	/**
	 * The attributes that are appends with relation.
	 *
	 * @var array
	 */
	protected $with = [
		'productCategory',
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
            'measure' => 'required|string|in:linear,square,cubic',
            'price' => 'required|integer|digits_between:1,11',
            'isSpecial' => 'boolean',
            'productCategory.id' => 'required|integer|digits_between:1,11',
        ];
	}

    /**
     * Get the materials for the material category.
     */
    public function productCategory()
    {
        return $this->belongsTo('App\Models\ProductCategory');
    }
}
