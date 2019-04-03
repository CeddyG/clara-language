<?php

namespace CeddyG\ClaraLanguage\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CeddyG\ClaraLanguage\ClaraLanguage
 */
class ClaraLang extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'clara.lang';
    }
}
