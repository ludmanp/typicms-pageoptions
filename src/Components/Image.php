<?php

namespace TypiCMS\Modules\PageOptions\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use TypiCMS\Modules\Core\Models\File;

class Image extends Component
{
    public function __construct(
        public string $name,
        public Model $model,
        public ?string $label = null,
    ) {
    }

    public function render()
    {
        if (data_get($this->model->options, $this->name)) {
            $image = File::find(data_get($this->model->options, $this->name));
        }

        return view('page-options::components.image', ['image' => $image ?? 'null']);
    }
}
