<?php

namespace TypiCMS\Modules\PageOptions\Composers;

use Illuminate\Contracts\View\View;
use TypiCMS\Modules\Core\Models\Page;
use TypiCMS\Modules\Pageoptions\Models\Pageoption;

class PublicPageOptionsComposer
{
    public function compose(View $view)
    {
        if (($view->page ?? false) && $view->page instanceof Page) {
            $pageOptions = Pageoption::where('page_id', $view->page->id)->first();
            if (! $pageOptions) {
                $pageOptions = new Pageoption;
            }
            $view->pageOptions = $pageOptions;
        }
    }
}
