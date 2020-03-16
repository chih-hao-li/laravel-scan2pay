<?php

namespace Chihhaoli\Scan2Pay\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Scan2Pay
 *
 * @package Chihhaoli\Scan2Pay\Facades
 */
class Scan2Pay extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return \Chihhaoli\Scan2Pay\Scan2Pay::class;
    }
}
