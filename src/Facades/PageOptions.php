<?php

namespace TypiCMS\Modules\PageOptions\Facades;

use Illuminate\Support\Facades\Facade;
use TypiCMS\Modules\PageOptions\Models\PageOption;

/**
 * @see PageOption
 * @mixin PageOption
 */
class PageOptions extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PageOption::class;
    }
}
