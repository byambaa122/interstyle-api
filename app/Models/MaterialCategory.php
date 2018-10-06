<?php

namespace App\Models;

class MaterialCategory extends Base
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'material_categories';

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
     * Get the materials for the material category.
     */
    public function materials()
    {
        return $this->hasMany('App\Models\Material');
    }
}
