<?php

namespace Chihhaoli\Scan2Pay\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Easycard
 *
 * @package Chihhaoli\Scan2Pay\Facades
 */
class Easycard extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return \Chihhaoli\Scan2Pay\Easycard::class;
    }
}
