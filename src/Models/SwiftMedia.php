<?php


namespace LaravelDaddy\SwiftMedia\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SwiftMedia extends Model
{
    public function model(): MorphTo
    {
        return $this->morphTo('model', 'model_type', 'model_id');
    }
}
