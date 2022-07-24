<?php

namespace App\View\Components;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\View\Component;

class Translations extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $locale = App::getLocale();

        $translations = Cache::rememberForever("translations_$locale", function () use ($locale) {
            $translations = [];
            if (File::exists(resource_path("lang/$locale"))) {
                $translations = collect(File::allFiles(resource_path("lang/$locale")))
                    ->filter(function ($file) {
                        return $file->getExtension() === 'php';
                    })->flatMap(function ($file) {
                        return Arr::dot(File::getRequire($file->getRealPath()));
                    })->toArray();
            }

            return $translations;
        });

        return view('components.translations', [
            'translations' => $translations,
        ]);
    }
}
