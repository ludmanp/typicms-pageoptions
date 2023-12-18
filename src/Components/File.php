<?php

namespace TypiCMS\Modules\PageOptions\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use TypiCMS\Modules\Core\Models\File as FileModel;

class File extends Component
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
            $file = FileModel::find(data_get($this->model->options, $this->name));
        }

        return view('page-options::components.file', ['file' => $file ?? 'null']);
    }
}
