<?php

namespace Ghanem\Rating\Traits;

use Ghanem\Rating\Models\Rating;
use Illuminate\Database\Eloquent\Model;

trait Ratingable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function ratings()
    {
        return $this->morphMany(Rating::class, 'ratingable');
    }

    /**
     *
     * @return mix
     */
    public function avgRating()
    {
        return $this->ratings()->avg('rating');

    }

    /**
     *
     * @return mix
     */
    public function sumRating()
    {
        return $this->ratings()->sum('rating');
    }

    /**
     * @param $max
     *
     * @return mix
     */ 
    public function ratingPercent($max = 5)
    {
        $quantity = $this->ratings()->count();
        $total = $this->sumRating();
        return ($quantity * $max) > 0 ? $total / (($quantity * $max) / 100) : 0;
    }
    
    /**
     * @param $data
     * @param Model      $author
     * @param Model|null $parent
     *
     * @return static
     */
    public function rating($data, Model $author, Model $parent = null)
    {
        return (new Rating())->createRating($this, $data, $author);
    }

    /**
     * @param $id
     * @param $data
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function updateRating($id, $data, Model $parent = null)
    {
        return (new Rating())->updateRating($id, $data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteRating($id)
    {
        return (new Rating())->deleteRating($id);
    }

    public function getAvgRatingAttribute()
    {
        return $this->avgRating();
    }

    public function getratingPercentAttribute()
    {
        return $this->ratingPercent();
    }

    public function setSumRatingAttribute()
    {
        return $this->sumRating();
    }
}
