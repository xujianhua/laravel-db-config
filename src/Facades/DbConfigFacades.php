<?php
namespace Jani\DbConfig\Facades;

use Illuminate\Support\Facades\Facade;

class DbConfigFacades extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(){
        return 'DbConfigService';
    }
}