<?php

namespace TypiCMS\Modules\PageOptions\Presenters;

use Bkwld\Croppa\Facades\Croppa;
use Illuminate\Support\Facades\Storage;
use TypiCMS\Modules\Core\Presenters\Presenter;
use TypiCMS\Modules\Core\Models\File;

class ModulePresenter extends Presenter
{
    public function option($key, $default = null)
    {
        return data_get($this->entity->options, $key, $default);
    }

    public function optionTranslated($key, $default = null, $locale = null)
    {
        return $this->option($key . '.' . ($locale ?: config('app.locale')), $default);
    }

    public function optionsImage($key, $width = null, $height = null, array $options = [])
    {
        $path = '';

        if($image = $this->optionsFile($key)){
            $path = $image->path;
        }

        if (!Storage::exists($path)) {
            $path = $this->imgNotFound();
        }

        if (in_array(pathinfo($path, PATHINFO_EXTENSION), ['svg', 'gif'])) {
            return Storage::url($path);
        }

        return url(Croppa::url('storage/'.$path, $width, $height, $options));
    }

    public function optionsFile($key)
    {
        $file = null;
        if(data_get($this->entity->options, $key)){
            $file = File::find(data_get($this->entity->options, $key));
        }
        return $file;
    }
}
