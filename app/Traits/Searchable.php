<?php

namespace App\Traits;

trait Searchable
{
    /**
     * Scope a query to search.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param  string  $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search)
    {
		foreach ($this->searchable as $column) {
            $query->orWhere($column, 'LIKE', '%' . $search . '%');
		}

		return $query;
    }
}
