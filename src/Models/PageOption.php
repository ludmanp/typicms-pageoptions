<?php

namespace  TypiCMS\Modules\PageOptions\Models;

use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\PageOptions\Presenters\ModulePresenter;

class PageOption extends Base
{
    use PresentableTrait;

    protected $presenter = ModulePresenter::class;

    protected $casts = ['options' => 'array'];

}
