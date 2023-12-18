<?php

namespace TypiCMS\Modules\PageOptions\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class AdminForm extends Component
{
    public string $template = 'default';

    public function __construct(
        public Model $model
    ){
        $this->template = optional($this->model ?? null)->template ?: 'default';
    }

    public function render()
    {
        return view('page-options::components.admin-form');
    }
}
