<?php


namespace TypiCMS\Modules\PageOptions\Observers;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\PageOptions\Models\PageOption;

class PageOptionsObserver
{
    public function saving(Model $model)
    {
        $model->__unset('options');
    }

    public function saved(Model $model)
    {
        if (optional(request())->get('id') != $model->id) {
            return;
        }
        if(!optional(request())->has('options')){
            return;
        }
        $pageOptions = PageOption::query()->where('page_id', $model->id)->first();
        if (!$pageOptions) {
            $pageOptions = new PageOption();
        }
        $pageOptions->page_id = $model->id;
        $pageOptions->options = request()->options;
        $pageOptions->save();
    }
}
