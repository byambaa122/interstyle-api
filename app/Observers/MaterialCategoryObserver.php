<?php

namespace App\Observers;

use App\MaterialCategory;

class MaterialCategoryObserver
{
    /**
     * Handle the material category "created" event.
     *
     * @param  \App\MaterialCategory  $materialCategory
     * @return void
     */
    public function created(MaterialCategory $materialCategory)
    {
        //
    }

    /**
     * Handle the material category "updated" event.
     *
     * @param  \App\MaterialCategory  $materialCategory
     * @return void
     */
    public function updated(MaterialCategory $materialCategory)
    {
        //
    }

    /**
     * Handle the material category "deleted" event.
     *
     * @param  \App\MaterialCategory  $materialCategory
     * @return void
     */
    public function deleted(MaterialCategory $materialCategory)
    {
        $materialCategory->products()->delete();
    }

    /**
     * Handle the material category "restored" event.
     *
     * @param  \App\MaterialCategory  $materialCategory
     * @return void
     */
    public function restored(MaterialCategory $materialCategory)
    {
        //
    }

    /**
     * Handle the material category "force deleted" event.
     *
     * @param  \App\MaterialCategory  $materialCategory
     * @return void
     */
    public function forceDeleted(MaterialCategory $materialCategory)
    {
        //
    }
}
