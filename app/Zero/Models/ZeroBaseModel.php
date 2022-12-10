<?php

namespace App\Zero\Models;


trait ZeroBaseModel
{
    /**
     * Visible name of the Model in view
     * @var string
     */
    protected string $modelName;
    /**
     * Visible plural name of the Model in view
     * @var string
     */
    protected string $pluralName;

    protected string $translationsPrefix;

    public function addedToMenu(): bool
    {
        return $this->addedToMenu ?? false;
    }
    /**
     * @return string
     */
    protected function routePrefix(): string
    {
        return strtolower(get_class($this));
    }

    protected static array $actions = [
        'list',
        'show',
        'edit',
        'new',
        'remove'
    ];

    protected function translationsPrefix(): string
    {
        return $this->translationsPrefix ?? strtolower(get_class($this));
    }

    public function modelName(): string
    {
        return $this->modelName ?? strtolower(class_basename($this));
    }

}
