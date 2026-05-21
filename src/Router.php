<?php

declare(strict_types=1);

namespace App;

use App\Controller\ArticleController;
use App\Controller\CategoryController;
use App\Controller\Controller;
use App\Controller\ErrorController;
use App\Controller\HomeController;

final class Router
{
    /** @var array{
     *     config: array<string, mixed>,
     *     smarty: \Smarty,
     *     pdo: \PDO,
     *     categoryRepository: \App\Repository\CategoryRepository,
     *     articleRepository: \App\Repository\ArticleRepository
     * } */
    private array $deps;

    /**
     * @param array{
     *     config: array<string, mixed>,
     *     smarty: \Smarty,
     *     pdo: \PDO,
     *     categoryRepository: \App\Repository\CategoryRepository,
     *     articleRepository: \App\Repository\ArticleRepository
     * } $deps
     */
    public function __construct(array $deps)
    {
        $this->deps = $deps;
    }

    public function dispatch(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $uri = rtrim((string) $uri, '/') ?: '/';

        if ($uri === '/') {
            $this->run(HomeController::class, 'index');
            return;
        }

        if (preg_match('#^/category/([^/]+)$#', $uri, $matches) === 1) {
            $this->run(CategoryController::class, 'show', [$matches[1]]);
            return;
        }

        if (preg_match('#^/article/([^/]+)$#', $uri, $matches) === 1) {
            $this->run(ArticleController::class, 'show', [$matches[1]]);
            return;
        }

        $this->notFound();
    }

    /**
     * @param class-string<Controller> $controllerClass
     * @param list<mixed> $args
     */
    private function run(string $controllerClass, string $method, array $args = []): void
    {
        $controller = new $controllerClass($this->deps);
        $controller->$method(...$args);
    }

    private function notFound(): never
    {
        $this->run(ErrorController::class, 'notFound');
    }
}
