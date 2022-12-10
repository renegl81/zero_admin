<?php

namespace App\Zero\Services;

use Illuminate\Http\JsonResponse;

class MenuService
{
     public function getMenuItems(): JsonResponse
     {
         $items[0] = [
             [
                 "id" => 0,
                 "to" => '/',
                 "icon"  => "view-dashboard",
                 "label" => 'Dashboard',
                 "hasDropdown" => false
             ]
         ];
         $models = $this->getModelNames();
         foreach ($models as $key => $model){
              $className = 'App\\Models\\'. $model;
              $modelInstance = new $className;
              if(isset($modelInstance->addedToMenu) && $modelInstance->addedToMenu){
                  $items[0][] = [
                      "id" => $key + 1,
                      "to" => $modelInstance->menu['to'],
                      "icon"  => $modelInstance->menu['icon'],
                      "label" => $modelInstance->menu['label']
                  ];
              }
         }

         return new JsonResponse($items);
     }

    function getModelNames(): array
    {
        $path = app_path('Models') . '/*.php';
        return collect(glob($path))->map(fn ($file) => basename($file, '.php'))->toArray();
    }
}
