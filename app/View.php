<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\ViewNotFoundException;

class View {
    protected string $view;
    protected array $params;

    public function __construct(string $view, array $params = [])
    {
        $this->view = $view;
        $this->params = $params;
    }

    public static function make(string $view, array $params = []): static
    {
        return new static ($view, $params);
    }

    public function render(bool $withLayout = false): string
    {
        $path = VIEWS_PATH . '/' . $this->view . '.php';
        if (!file_exists($path)) {
            throw new ViewNotFoundException();
        }

        extract($this->params);

        ob_start();
        include $path;
        return (string) ob_get_clean();
    }

    public function __toString(): string
    {
        return $this->render();
    }

    public function __get(string $name)
    {
        return $this->params[$name];
    }
}