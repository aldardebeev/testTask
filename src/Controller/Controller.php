<?php

declare(strict_types=1);

namespace App\Controller;

use PDO;
use Smarty;

abstract class Controller
{
    protected Smarty $smarty;

    protected PDO $pdo;

    /** @var array<string, mixed> */
    protected array $config;

    /**
     * @param array{config: array<string, mixed>, smarty: Smarty, pdo: PDO} $deps
     */
    public function __construct(array $deps)
    {
        $this->config = $deps['config'];
        $this->smarty = $deps['smarty'];
        $this->pdo = $deps['pdo'];

        $this->smarty->assign('base_url', $this->config['base_url'] ?? '');
    }

    protected function render(string $template): void
    {
        $this->smarty->display($template);
    }

    protected function abortNotFound(): never
    {
        http_response_code(404);
        $this->render('errors/404.tpl');
        exit;
    }
}
