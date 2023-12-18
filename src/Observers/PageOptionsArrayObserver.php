<?php

namespace TypiCMS\Modules\PageOptions\Observers;

use Illuminate\Database\Eloquent\Model;

class PageOptionsArrayObserver
{
    public function saving(Model $model)
    {
        if (empty($model->options)) {
            $model->options = [];
        }

    }
}
