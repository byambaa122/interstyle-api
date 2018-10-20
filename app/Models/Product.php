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
        'images' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //
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
            //
        ];
	}

    /**
     * Get the materials for the material category.
     */
    public function productCategory()
    {
        return $this->hasMany('App\Models\ProductCategory');
    }
}
