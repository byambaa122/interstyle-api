<?php

namespace App\Models;

class ProductCategory extends Base
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'product_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image',
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
            'image' => 'required|string|max:255',
        ];
	}

    /**
     * Get the products for the product category.
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
