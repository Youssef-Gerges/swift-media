<?php

namespace LaravelDaddy\SwiftMedia\Facade;

use Illuminate\Support\Facades\Facade;

class SwiftMedia extends Facade
{
    protected static function getFacadeAccessor(){
        return 'swift-media';
    }

}
