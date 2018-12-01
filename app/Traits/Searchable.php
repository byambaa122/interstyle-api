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
        collect($this->searchable)->map(function ($column) use ($query, $search) {
            $query->orWhere($column, 'LIKE', '%' . $search . '%');
        });

        return $query;
    }
}
