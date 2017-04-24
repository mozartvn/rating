<?php

namespace Ghanem\Rating\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Rating
{
    public function ratings();

    public function avgRating();

    public function sumRating();

    public function ratingPercent($max = 5);
    
    public function rating($data, Model $author, Model $parent = null);

    public function updateRating($id, $data, Model $parent = null);

    public function deleteRating($id);

    public function getAvgRatingAttribute();

    public function getratingPercentAttribute();

    public function setSumRatingAttribute();
}